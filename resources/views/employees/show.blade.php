@extends('layouts.app')
@section('title', 'Single Employee')

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
                    <form action="{{route('employee.edit', ['id' => $employee->id])}}" method="post">
                        <div class="form-group">
                            <label name="firstname">First name:</label>
                            <input type="text" name="firstname" value="{{$employee->firstname}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label name="lastname">Last name:</label>
                            <input type="text" name="lastname" value="{{$employee->lastname}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label name="company">Company:</label>
                            <select name="company" class="form-control">
                                @foreach($company as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label name="email">E-Mail address:</label>
                            <input type="text" name="email" value="{{$employee->email}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label name="phone">Phone:</label>
                            <input type="text" name="phone" value="{{$employee->phone}}" class="form-control">
                        </div>
                        <input type="submit" value="Edit" class="btn btn-info">
                        @method('PUT')
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
