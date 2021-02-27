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
                <form enctype="multipart/form-data" method="POST" action="{{route('companies.store')}}">
                    <div class="form-group">
                        <label name="name">Name of the Company</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label name="email">E-mail Adress:</label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label name="website">Name of the Website:</label>
                        <input type="text" name="website" class="form-control">
                    </div>
                    <div class="form-group">
                        <label name="logo">Logo:</label>
                        <input type="file" name="logo" id="logo" class="form-control-file">
                    </div>
                    <input type="submit" placeholder="Add" class="btn btn-primary">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@stop

