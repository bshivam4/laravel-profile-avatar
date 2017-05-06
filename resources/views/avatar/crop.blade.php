@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1>{{$success}}</h1>
        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Some issues with the file.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



            <div class="container text-center">
                <div class="row">
                    <div class="col-md-12">
                        <img class="img-responsive" src="{{asset('profile_pictures')}}/{{$imageName}}" id="target" width="1000px"/>
                    </div>
                </div>


            </div>
            <div class="row">
                <div id="preview-pane">
                    <div class="preview-container">
                        <img id="myImg" src="{{asset('profile_pictures')}}/{{$imageName}}" class="jcrop-preview" alt="Preview" />
                    </div>
                </div>
            </div>
            <!-- This is the form that our event handler fills -->
            <form action="{{route('save')}}" method="post" enctype="multipart/form-data" onsubmit="return checkCoords();">
                {{ csrf_field() }}
                <input type="hidden" required id="x" name="x" />
                <input type="hidden" required id="y" name="y" />
                <input type="hidden" required id="w" name="w" />
                <input type="hidden" required id="h" name="h" />
                <input type="hidden" required id="ysize" name="height" />
                <input type="hidden" required id="xsize" name="width" />
                <input type="hidden" required value="{{$imageName}}" name="imgName">
                <input type="submit" value="Crop Image" class="btn btn-large btn-inverse" />
            </form>

    </div>
@endsection