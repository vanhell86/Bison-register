@extends('layouts.app')

@section('content')

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('danger'))
            <div class="alert alert-danger">
                {{ session('danger') }}
            </div>
        @endif
        <h1>Add participant result</h1>
        <form class="mt-5" action="{{route('results.store')}}" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="user_id">Start number</label>
                    <input type="text" class="form-control" id="user_id" name="participant_id"
                           placeholder="Participant start number">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="time">Time</label>
                    <input type="text" class="form-control" id="time" name="time" placeholder="Time">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="mr-sm-2 ml-1" for="inlineFormCustomSelect">Stage number</label>
                    <select class="custom-select mr-sm-2 ml-1" id="inlineFormCustomSelect" name="stage_number">
                        <option selected>Choose...</option>
                        @foreach((range(1,8)) as $stage)
                            <option value="{{$stage}}">{{$stage}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>

    </div>

@endsection
