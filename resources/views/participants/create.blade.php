@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1>Add new participant</h1>
        <form class="mt-5" action="{{route('participants.store')}}" method="post">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="surname">Surname</label>
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname">
                </div>
            </div>
            <fieldset class="form-group">
                <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gridRadios1"
                                   value="V" checked>
                            <label class="form-check-label" for="gridRadios1">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gridRadios2"
                                   value="S">
                            <label class="form-check-label" for="gridRadios2">
                                Female
                            </label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="form-row">
                <div class="form-group">
                    <label class="mr-sm-2 ml-1" for="inlineFormCustomSelect">Date of birth</label>
                    <select class="custom-select mr-sm-2 ml-1" id="inlineFormCustomSelect" name="birthdate">
                        <option selected>Choose...</option>
                        @foreach((range(2012,1930,-1)) as $year)
                            <option value="{{$year}}">{{$year}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
@endsection
