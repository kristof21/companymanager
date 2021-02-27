@extends('layouts.app')
@section('title', 'Single Company')

@section('content')

    <div class="container pt-4">
        <div class="row">
            <div class="col-md">
                <h2>{{$company->name}}</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                @if(!is_null($company->logo))
                <img class="float-right" width="300px" height="auto" src="{{asset('storage/' . $company->logo )}}">
                @endif
            </div>
            <div class="col-md">
                <div class="text-justify-center">
                    <form action="{{route('companies.edit', ['company' => $company->id])}}" enctype="multipart/form-data" method="post" class="pull-right">
                        <div class="form-group">
                            <label name="name">Name of the Company:</label>
                            <input type="text" name="name" value="{{$company->name}}" readonly="true" class="form-control">
                        </div>
                        <div class="form-group">
                            <label name="email">E-mail address:</label>
                            <input type="text" name="email" value="{{$company->email}}" readonly="true" class="form-control">
                        </div>
                        <div class="form-group">
                            <label name="website">Name of the Website:</label>
                            <input type="text" name="website" value="{{$company->website}}" readonly="true" class="form-control">
                        </div>
                        <div class="form-group">
                            <label name="logo">Logo:</label>
                            <input type="file" name="logo" disabled="disabled" class="file-upload">
                        </div>
                        <button type="button" name="Edit" class="btn btn-info d-inline-block" id="edit-company">Edit</button>
                        <input type="submit" value="Save" class="btn btn-success d-none save">
                        @method('put')
                        @csrf
                    </form>
                    <form method="POST" action="{{route('companies.removeLogo', ['company' => $company->id])}}">
                        <input type="submit" value="Remove logo" class="btn btn-danger mt-2 remove-logo d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md">
                <h3>Employee's</h3>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-md">
                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        @if (Auth::check())
                            <th>Actions</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employee as $key => $value)
                        <tr>
                            <td>{{$value->firstname}}</td>
                            <td>{{$value->lastname}}</td>
                            <td>{{$value->email}}</td>
                            <td>{{$value->phone}}</td>
                            @if (Auth::check())
                                <td>
                                    <span class="form-inline justify-content-center">
                                        <form action="{{route('employee.show', ['employee' => $value->id])}}" method="GET">
                                            <input type="submit" value="Edit" class="btn btn-info">
                                        </form>
                                        /
                                        <form action="{{route('employee.remove', ['employee' => $value->id])}}" method="POST">
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </span>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/js/edit.js"></script>
@stop
