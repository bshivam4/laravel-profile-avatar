@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row text-center">
        @if($success=='saved')
            <div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success !</strong> File uploaded Successfully.
            </div>
        @endif


    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading"><h4>Dashboard</h4></div>

                <div class="panel-body text-center">
                    Welcome<b> {{ Auth::user()->name }}</b>
                    <hr>
                    <img src="{{$picture}}" height="300px" class="img-circle" />
                    <hr>
                    To change your profile picure, click the button below :
                    <hr>
                    <a class="btn btn-success" href="{{route('avatar')}}">Change Profile Picure</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
