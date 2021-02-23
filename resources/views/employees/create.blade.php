@extends('layouts.app')
@section('title', 'Add an employee')

@section('content')
    <div class="container pt-4">
        <div class="row pt-4">
            <div class="col-md pt-4">
                <h2>Add an employee</h2>
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
                <div class="text-justify-center">
                    {{ Form::open(array('url' => 'employee/store')) }}

                    <div class="form-group">
                        {{ Form::label('surname', 'Surname:') }}
                        {{ Form::text('surname', '', array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('lastname', 'Lastname:') }}
                        {{ Form::text('lastname', '', array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                    {{ Form::label('company', 'Company:') }}
                    {{ Form::select('company', $company, null, array('class' => 'form-control')) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('email', 'Email:') }}
                        {{ Form::text('email', '', array('class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('phone', 'Phone:') }}
                        {{ Form::text('phone', '', array('class' => 'form-control')) }}
                    </div>

                    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@stop

