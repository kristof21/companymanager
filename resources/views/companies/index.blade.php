@extends('layouts.app')
@section('title', 'Companies')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md mt-5">
                <h3 class="text-left">Companies</h3>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-auto mt-5">
                <table class="table table-striped table-responsive text-center">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Number of employees</th>
                        @if (Auth::check())
                            <th>Remove</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody class="">
                    @foreach($companies as $key => $value)
                        <tr>
                            <td class="align-middle">
                                @if(!is_null($value->logo))
                                    <img src="{{url('storage/' . $value->logo )}}" height="auto" width="100">
                                @endif
                                @if (Auth::check())
                                    <a href="{{ URL::to('companies/show/' . $value->id) }}">{{$value->name}}</a></td>
                                @else
                                    {{$value->name}}</td>
                                @endif
                            <td class="align-middle">{{$value->email}}</td>
                            <td class="align-middle">{{$value->website}}</td>
                            <td class="align-middle">{{$value->employe_count}}</td>
                            @if (Auth::check())
                                <td class="align-middle">
                                    {{ Form::open(array('url' => 'companies/remove/' . $value->id, 'class' => 'pull-right')) }}
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

@stop
