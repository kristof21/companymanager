@extends('layouts.app')
@section('title', 'Single Employe')

@section('content')

    <div class="container pt-4">
        <div class="row">
            <div class="col-md">
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
                <div class="text-justify-center">
                    {{ Form::open(array('url' => 'employee/edit/' . $employe->id, 'class' => 'pull-right', 'method' => 'PUT')) }}

                    <div class="form-group">
                        {{ Form::label('surname', 'Surname:') }}
                        {{ Form::text('surname', "$employe->surname", array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('lastname', 'Lastname:') }}
                        {{ Form::text('lastname', "$employe->lastname", array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('company', 'Company:') }}
                        {{ Form::select('company', $company, null, array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', 'E-Mail Address:') }}
                        {{ Form::text('email', "$employe->email", array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('phone', 'Phone:') }}
                        {{ Form::text('phone', "$employe->phone", array('class' => 'form-control')) }}
                    </div>
                        <div class="form-group">
                        </div>
                        {{ Form::submit('Edit', array('class' => 'btn btn-success')) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop
