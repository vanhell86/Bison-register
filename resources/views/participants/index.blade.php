@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{ url('/calculateResults') }}" class="btn btn-xs btn-info pull-right">Calculate</a>
        <div class="table-responsive stage">
            <table class="table table-hover table-striped 0">
                <caption>List of participants</caption>
                <thead>
                <tr>
                    <th scope="col">Vecuma grupa</th>
                    <th scope="col">Starta numurs</th>
                    <th scope="col">Vārds</th>
                    <th scope="col">Uzvārds</th>
                    <th scope="col">Punkti</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $participants as $participant)
                    <tr>
                        <td>{{$participant->age_group}}</td>
                        <td>{{$participant->id}}</td>
                        <td>{{$participant->name}}</td>
                        <td>{{$participant->surname}}</td>
                        <td>{{$participant->total_points}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
