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
                            <th>Delete</th>
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
                                    <a href="{{ route('companies.show', ['id' => $value->id]) }}">{{$value->name}}</a></td>
                                @else
                                    {{$value->name}}</td>
                                @endif
                            <td class="align-middle">{{$value->email}}</td>
                            <td class="align-middle">{{$value->website}}</td>
                            <td class="align-middle">{{$value->employee_count}}</td>
                            @if (Auth::check())
                                <td class="align-middle">
                                    <form method="post" action="{{route('companies.remove', ['id' => $value->id])}}" >
                                        <input type="submit" value="Delete" class="btn btn-danger">
                                        @method('delete')
                                        @csrf
                                    </form>
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
