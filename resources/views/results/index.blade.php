@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{ url('/results/calculate') }}" class="btn btn-xs btn-info pull-right">Calculate</a>
        <section class="col-md-2  float-right d-inline-flex">
            <select class="custom-select form-control" id="stageSelect" name="stage">
                <option value="0">Choose stage</option>
                <option value="1">Stage 1</option>
                <option value="2">Stage 2</option>
                <option value="3">Stage 3</option>
                <option value="4">Stage 4</option>
                <option value="5">Stage 5</option>
                <option value="6">Stage 6</option>
                <option value="7">Stage 7</option>
                <option value="8">Stage 8</option>
            </select>
        </section>
        @foreach(range(1,8) as $stage)
            <table class="table table-hover table-striped {{$stage}}" style="display:none">
                <caption>List of stage {{$stage}} results</caption>
                <thead>
                <tr>
                    <th scope="col">Vecuma grupa</th>
                    <th scope="col">Starta numurs</th>
                    <th scope="col">Vārds</th>
                    <th scope="col">Uzvārds</th>
                    <th scope="col">Laiks</th>
                    <th scope="col">Punkti</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $results->where('stage_number', $stage) as $result)
                    <tr>
                        <td>{{$result->age_group}}</td>
                        <td>{{$result->participant_id}}</td>
                        <td>{{$result->participant->name}}</td>
                        <td>{{$result->participant->surname}}</td>
                        <td>{{$result->time}}</td>
                        <td>{{$result->points}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
    </div>
@endsection
