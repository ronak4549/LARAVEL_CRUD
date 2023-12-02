@extends('layouts.app')

@section('title', 'Excel_Upload')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-3">Excel Upload</h2>
            </div>
        </div>
        <form action="{{ route('crud.addExcelData') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <h2>Excel_Upload:</h2>
                    <input type="file" name="upload_excel" class="form-control" placeholder="File Upload">
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
