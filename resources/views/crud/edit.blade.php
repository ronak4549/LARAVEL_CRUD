@extends('layouts.app')

@section('title', 'Edit')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-3">Edit Crud!</h2>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('crud.index') }}"> Back</a>
                </div>
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
        <form action="{{ route('crud.update', $results->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $results->id }}">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>First Name:</strong>
                        <input type="text" name="first_name" class="form-control" value={{ $results->first_name }}
                            placeholder="Enter First Name">
                    </div>
                    <div class="form-group">
                        <strong>Last Name:</strong>
                        <input type="text" name="last_name" class="form-control" value={{ $results->last_name }}
                            placeholder="Enter Last Name">
                    </div>
                    <div class="form-group">
                        <strong>Email Id:</strong>
                        <input type="text" name="email" class="form-control" value={{ $results->email }}
                            placeholder="Enter Email-Id">
                    </div>
                    <div class="form-group">
                        <strong>Gender:</strong>
                        <input type="radio" name="gender" id="Male" value="Male"
                            @if ($results->gender == 'Male') checked @endif><label for="Male">Male</label>
                        <input type="radio" name="gender" id="Female"value="Female"
                            @if ($results->gender == 'Female') checked @endif><label for="Female">Female</label>

                        {{-- <input type=radio name="Gender" value="Male"
                            {{ $results->gender === 'Male' ? 'checked' : '' }}>Male</option>
                        <input type=radio name="Gender" value="Female"
                            {{ $results->gender === 'Female' ? 'checked' : '' }}>Female</option> --}}
                    </div>
                    <div class="form-group">
                        <strong>Hobby:</strong>
                        {{-- <label><input type="checkbox" name="hobby[]" id="hobby" value="cricket"
                                @if ($results->hobby == 'cricket') selected @endif>Cricket</label>
                        <label><input type="checkbox" name="hobby[]" id="hobby" value="football"
                                @if ($results->hobby == 'football') selected @endif>Football</label>
                        <label><input type="checkbox" name="hobby[]" id="hobby" value="travelling"
                                @if ($results->hobby == 'travelling') selected @endif>Travelling</label>
                        <label><input type="checkbox" name="hobby[]" id="hobby" value="basketball"
                                @if ($results->hobby == 'basketball') selected @endif>Basketball</label> --}}

                        {{-- <label><input type="checkbox" name="hobby[]" id="cricket" value="cricket"
                                {{ in_array('cricket', $results->hobby) ? 'checked' : '' }}>Cricket</label>
                        <label><input type="checkbox" name="hobby[]" id="football" value="football"
                                {{ in_array('football', $results->hobby) ? 'checked' : '' }}>Football</label>
                        <label><input type="checkbox" name="hobby[]" id="travelling" value="travelling"
                                {{ in_array('travelling', $results->hobby) ? 'checked' : '' }}>Travelling</label>
                        <label><input type="checkbox" name="hobby[]" id="basketball" value="basketball"
                                {{ in_array('basketball', $results->hobby) ? 'checked' : '' }}>Basketball</label> --}}

                        <label><input type="checkbox" name="hobby[]" id="cricket" value="cricket"
                                {{ in_array('cricket', $results->result_hobbies) ? 'checked' : '' }}>Cricket</label>
                        <label><input type="checkbox" name="hobby[]" id="football" value="football"
                                {{ in_array('football', $results->result_hobbies) ? 'checked' : '' }}>Football</label>
                        <label><input type="checkbox" name="hobby[]" id="travelling" value="travelling"
                                {{ in_array('travelling', $results->result_hobbies) ? 'checked' : '' }}>Travelling</label>
                        <label><input type="checkbox" name="hobby[]" id="basketball" value="basketball"
                                {{ in_array('basketball', $results->result_hobbies) ? 'checked' : '' }}>Basketball</label>
                    </div>
                    <div class="form-group">
                        <strong>Select City:</strong>
                        <select name="city_id" class="form-control">
                            @foreach ($cities as $category)
                                <option @if ($results->city_id == $category->id) selected @endif value="{{ $results->id }}">
                                    {{ $category->city_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        @if ($results->image)
                            <h6 class="small-title">
                                {{ __('image') }}
                            </h6>
                            <img src="{{ asset('crud_img/' . $results->image) }}" id="image" alt="application-image"
                                width="150px" height="150px" class="rounded-circle img-thumbnail w-10">
                        @endif
                        <div class="choose-file mt-3">
                            <label for="image">
                                <input type="file" class="form-control" name="image" value="{{ $results->image }}"
                                    id="image" data-filename="image-logo">
                            </label>
                            <p class="image-logo"></p>
                            <span class="invalid-feedback" role="alert">
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <strong>Address:</strong>
                        <textarea class="form-control" placeholder="Enter Address" name="address">{{ $results->address }}</textarea>
                    </div>
                    <div class="form-group">
                        <strong>Contact:</strong>
                        <input type="text" name="contact" class="form-control" value={{ $results->contact }}
                            placeholder="Contact">
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
