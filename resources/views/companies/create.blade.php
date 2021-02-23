@extends('layouts.app')
@section('title', 'Add a company')

@section('content')
<div class="container pt-4">
    <div class="row pt-4">
        <div class="col-md pt-4">
            <h2>Add a company</h2>
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
                {{ Form::open(array('url' => 'companies/store', 'enctype' => 'multipart/form-data')) }}

                <div class="form-group">
                    {{ Form::label('name', 'Name of the Company:') }}
                    {{ Form::text('name', '', array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'E-Mail Address:') }}
                    {{ Form::text('email', '', array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('website', 'Name of the Website:') }}
                    {{ Form::text('website', '', array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('logo', 'Logo:') }}
                    {{ Form::file('logo', array('name' => 'logo', 'id' => 'logo', 'class' => 'form-control-file')) }}
                </div>

                {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop

