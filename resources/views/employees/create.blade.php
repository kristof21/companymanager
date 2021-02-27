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
                    <form action="{{route('employee.store')}}" method="POST">
                        <div class="form-group">
                            <label name="firstname">First name:</label>
                            <input type="text" name="firstname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label name="lastname">Last name:</label>
                            <input type="text" name="lastname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label name="company">Company:</label>
                            <select name="company_id" class="form-control">
                                @foreach($company as $key => $value)
                                    <option name="company_id" value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label name="email">Email:</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label name="phone">Phone:</label>
                            <input type="text" name="phonee" class="form-control">
                        </div>
                        <input type="submit" class="btn btn-primary">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

