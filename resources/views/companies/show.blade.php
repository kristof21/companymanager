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
                <img class="float-right" width="300px" height="auto" src="{{url('storage/' . $company->logo )}}">
                @endif
            </div>
            <div class="col-md">
                <div class="text-justify-center">
                    {{ Form::open(array('url' => 'companies/edit/' . $company->id, 'class' => 'pull-right', 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}

                    <div class="form-group">
                        {{ Form::label('name', 'Name of the Company:') }}
                        {{ Form::text('name', "$company->name", array('class' => 'form-control', 'readonly' => 'true')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('email', 'E-Mail Address:') }}
                        {{ Form::text('email', "$company->email", array('class' => 'form-control', 'readonly' => 'true')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('website', 'Name of the Website:') }}
                        {{ Form::text('website', "$company->website", array('class' => 'form-control', 'readonly' => 'true')) }}
                    </div>
                    @if (Auth::check())
                        <div class="form-group">
                            {{ Form::label('logo', 'Logo:') }}
                            {{ Form::file('logo', array('class' => 'file-upload','disabled' =>'disabled')) }}
                        </div>
                        {{ Form::button('Edit', array('class' => 'btn btn-primary d-inline-block', 'id' => "edit-company")) }}
                        {{ Form::submit('Save', array('class' => 'btn btn-success d-none save')) }}

                        {{ Form::close() }}
                        {{ Form::open(array('url' => 'companies/removeLogo/' . $company->id)) }}
                        {{ Form::hidden('_method', 'POST') }}
                        {{ Form::submit('Remove logo', array('class' => 'btn btn-danger mt-2')) }}
                        {{ Form::close() }}
                    @endif
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
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Surname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Phone</th>
                        @if (Auth::check())
                            <th>Show</th>
                            <th>Remove</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employee as $key => $value)
                        <tr>
                            <td>{{$value->surname}}</td>
                            <td>{{$value->lastname}}</td>
                            <td>{{$value->email}}</td>
                            <td>{{$value->phone}}</td>
                            @if (Auth::check())
                                <td>
                                    {{ Form::open(array('url' => 'employee/show/' . $value->id)) }}
                                    {{ Form::hidden('_method', 'GET') }}
                                    {{ Form::submit('Show', array('class' => 'btn btn-info')) }}
                                    {{ Form::close() }}
                                </td>
                                <td>
                                    {{ Form::open(array('url' => 'employee/remove/' . $value->id)) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                                    {{ Form::close() }}
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
