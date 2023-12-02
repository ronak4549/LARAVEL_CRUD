@extends('layouts.app')

@section('title', 'Index')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-3">View CRUD-Detail</h2>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('crud.create') }}"> ADD NEW </a>
                        </div>
                    </div>
                </div>
                <br>
                <div class="content">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <tr style="background:#808080; color:#FFF;">
                            <td>No</td>
                            <th>Image</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Contact</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($results as $key => $result)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td><img @if ($result->image) src="{{ asset('crud_img/' . $result->image) }}" @else avatar="{{ $result->image }}" @endif
                                        id="image" alt="user-image" width="50px" height="50px"
                                        class="rounded-circle img-thumbnail w-10"></td>
                                <td>{{ $result->first_name }}</td>
                                <td>{{ $result->last_name }}</td>
                                <td>{{ $result->email }}</td>
                                <td>{{ $result->city_name }}</td>
                                <td>{{ $result->contact }}</td>
                                <td>
                                    <form action="{{ route('crud.destroy', $result->id) }}" method="POST">
                                        <a class="btn btn-info" href="{{ route('crud.show', $result->id) }}"><i
                                                class="fas fa-solid fa-eye"></i></a>

                                        <a class="btn btn-primary" href="{{ route('crud.edit', $result->id) }}"><i
                                                class="fa fa-pen"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {!! $results->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
