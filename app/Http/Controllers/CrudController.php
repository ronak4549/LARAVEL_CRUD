<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Crud;
use App\Models\ExcelData;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Yajra\DataTables\DataTables;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Crud::select('cruds.*', 'cities.id as city_id', 'cities.city_name')
            ->leftJoin('cities', 'cities.id', '=', 'cruds.city_id')
            ->paginate(5);
        return view('crud.index', compact('results'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['cities'] = City::select('id', 'city_name')->get();
        return view('crud.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'first_name' => 'required|regex:/^[a-zA-Z]+$/u',
            'last_name' => 'required|regex:/^[a-zA-Z]+$/u',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|email|unique:cruds,email',
            'password' => 'required|min:8',
            'gender' => 'required',
            'hobby' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp',
            'address' => 'required',
            'contact' => 'required|numeric|digits:10',
        ]);

        $insertData = new Crud();

        $filename = $insertData->image;
        if ($request->hasFile('image')) {
            $destination = 'crud_img/' . $insertData->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalName();
            $filename = $extention;
            $file->move(public_path('crud_img/'), $filename);
        }

        $insertData->first_name = $request->first_name;
        $insertData->last_name = $request->last_name;
        $insertData->email = $request->email;
        $insertData->password = Hash::make($request->password);
        $insertData->gender = $request['gender'] ? $request['gender'] : 'Male';
        $insertData->hobby = json_encode($request->hobby);
        //$insertData->hobby = explode(',', $request->hobby);
        $insertData->image = $filename;
        $insertData->address = $request->address;
        $insertData->contact = $request->contact;
        $insertData->city_id = $request->city_id;

        $insertData->save();

        return redirect('crud-list')
            ->with('success', 'Record Insert Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $results =  Crud::leftJoin('cities', 'cities.id', '=', 'cruds.city_id')->find($id);
        return view('crud.show', compact('results'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::select('id', 'city_name')->get();
        $results =  Crud::find($id);
        $results->result_hobbies = json_decode($results->hobby);

        return view('crud.edit', compact('results', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'first_name' => 'required|regex:/^[a-zA-Z]+$/u',
            'last_name' => 'required|regex:/^[a-zA-Z]+$/u',
            'email' => 'required',
            'gender' => 'required',
            'hobby' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp',
            'address' => 'required',
            'contact' => 'required|numeric|digits:10',
        ]);

        $updateData = Crud::find($request->id);

        $filename = $updateData->image;

        if ($request->hasFile('image')) {
            $destination = 'crud_img/' . $updateData->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extention = $file->getClientOriginalName();
            $filename = $extention;
            $file->move(public_path('crud_img/'), $filename);
        }
        //dd($updateData);
        $updateData->first_name = $request->get('first_name');
        $updateData->last_name = $request->get('last_name');
        $updateData->email = $request->get('email');
        $updateData->gender = $request['gender'] ? $request['gender'] : 'Male';
        $updateData->hobby = json_encode($request->hobby);
        //$updateData->hobby = explode(',', $request->hobby);
        $updateData->address = $request->get('address');
        $updateData->contact = $request->get('contact');
        $updateData->image = $filename;
        $updateData->city_id = $request->get('city_id');
        //dd($updateData);
        $updateData->save();
        return redirect('crud-list')->with('success', 'Record Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result_delete = Crud::find($id);
        $image_path = public_path("crud_img/$result_delete->image}");
        if (File::exists($image_path)) {
            unlink($image_path);
        }
        $result_delete->delete();
        return redirect('crud-list')
            ->with('success', 'Record deleted Successfully');
    }

    /* ====================================================================================== */

    public function dataTableView()
    {
        //dd("HIII");
        if (\request()->ajax()) {
            $data = ExcelData::latest()->get();
            //dd($data);
            return DataTables::of($data)
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('crud.tableViewIndex');
    }

    public function fileupload()
    {
        return view('crud.excel_upload');
    }

    public function addExcelData(Request $request)
    {
        $the_file = $request->file('upload_excel');

        $spreadsheet  = IOFactory::load($the_file->getRealPath());
        $sheet        = $spreadsheet->getActiveSheet();
        $row_limit    = $sheet->getHighestDataRow();
        $column_limit = $sheet->getHighestDataColumn();
        $row_range    = range(2, $row_limit);
        $column_range = range('F', $column_limit);
        $data_insert = array();

        $filename = "";

        if ($request->hasFile('upload_excel')) {
            $file = $request->file('upload_excel');
            $filename = $file->getClientOriginalName();
            $file->move('storage/excelsheet/', $filename);
        }

        foreach ($row_range as $row) {

            $ResultsData = ExcelData::where('email', $sheet->getCell('C' . $row)->getValue())->get();

            if (count($ResultsData) > 0) {
                ExcelData::where('email', $sheet->getCell('C' . $row)->getValue())
                    ->update([
                        'name' => $sheet->getCell('A' . $row)->getValue(),
                        'surname' => $sheet->getCell('B' . $row)->getValue(),
                        'email' => $sheet->getCell('C' . $row)->getValue(),
                        'age' => $sheet->getCell('D' . $row)->getValue(),
                        'city' => $sheet->getCell('E' . $row)->getValue(),
                        'contact' => $sheet->getCell('F' . $row)->getValue(),
                    ]);
            } else {
                if ($sheet->getCell('C' . $row)->getValue() != null) {
                    $data_insert[] = [
                        'name' => $sheet->getCell('A' . $row)->getValue(),
                        'surname' => $sheet->getCell('B' . $row)->getValue(),
                        'email' => $sheet->getCell('C' . $row)->getValue(),
                        'age' => $sheet->getCell('D' . $row)->getValue(),
                        'city' => $sheet->getCell('E' . $row)->getValue(),
                        'contact' => $sheet->getCell('F' . $row)->getValue(),
                    ];
                }
            }
        }

        if (count($data_insert) > 0) {
            ExcelData::insert($data_insert);
            return view('crud.tableViewIndex')->with('success', 'Record Added Successfully.');
        } else {
            return view('crud.tableViewIndex')->with('success', 'Record Updated Successfully.');
        }
    }

    public function test(Request $request)
    {
        $address = storage_path('excelsheet/excel_data.xlsx');
        //dd($address);
        $reader = new Xlsx();
        $test = $reader->load($address);
        $sheet = $test->getActiveSheet();
        $results = $reader->listWorksheetInfo($address);

        $totalrows = $results[0]['totalRows'];
        for ($row = 2; $row <= $totalrows; $row++) {
            echo $firstname = $sheet->getCell("A{$row}")->getValue();
            echo $lastname = $sheet->getCell("B{$row}")->getValue();
            echo $mail = $sheet->getCell("C{$row}")->getValue();
            echo $age = $sheet->getCell("D{$row}")->getValue();
            echo $city = $sheet->getCell("E{$row}")->getValue();
            echo $contact = $sheet->getCell("F{$row}")->getValue();

            echo "{$firstname} | {$lastname} | {$mail} | {$age} | {$city} | {$contact}" . '<br>';
        }
    }

    public function send_mail(Request $request)
    {
        $data["email"] = "ronak.webplanex@gmail.com";
        $data["title"] = "This is My First Mail";

        $files = [
            public_path('attachments/Laravel.jpg'),
            public_path('attachments/PDF Bookmark Sample.pdf'),
        ];

        Mail::send('mail.Test_mail', $data, function ($message) use ($data, $files) {
            $message->to($data["email"])
                ->subject($data["title"]);

            foreach ($files as $file) {
                $message->attach($file);
            }
        });
        $send = "Mail send successfully !!";
        return redirect('home')->with('success', $send);
    }
}
