@extends('layouts.app')

@section('title', 'Create')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-3">CRUD!</h2>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops Something Wrong !!</strong> <br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('crud.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>First Name:</strong>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}"
                            placeholder="Enter First Name">
                    </div>
                    <div class="form-group">
                        <strong>Last Name:</strong>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}"
                            placeholder="Enter Last Name">
                    </div>
                    <div class="form-group">
                        <strong>Email Id:</strong>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}"
                            placeholder="Enter Email-Id">
                    </div>
                    <div class="form-group">
                        <strong>Password:</strong>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                        <strong>Gender:</strong>
                        <input type="radio" name="gender" value="Male"> Male
                        <input type="radio" name="gender" value="Female"> Female
                    </div>
                    <div class="form-group">
                        <strong>Hobby:</strong>
                        <label><input type="checkbox" name="hobby[]" value="cricket"> Cricket</label>
                        <label><input type="checkbox" name="hobby[]" value="football"> Football</label>
                        <label><input type="checkbox" name="hobby[]" value="travelling"> Travelling</label>
                        <label><input type="checkbox" name="hobby[]" value="basketball"> Basketball</label>
                    </div>
                    <div class="form-group">
                        <strong>Select City:</strong>
                        <select name="city_id" class="form-control">
                            <option>--------Select Options--------</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <strong>Photo:</strong>
                        <input type="file" name="image" class="form-control" placeholder="File">
                    </div>
                    <div class="form-group">
                        <strong>Address:</strong>
                        <textarea class="form-control" placeholder="Enter Address" name="address">{{ old('address') }}</textarea>
                    </div>
                    <div class="form-group">
                        <strong>Contact:</strong>
                        <input type="text" name="contact" class="form-control" value="{{ old('contact') }}"
                            placeholder="Contact">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
