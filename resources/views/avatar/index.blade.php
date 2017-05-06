@extends('layouts.app')

@section('content')
    <div class="container text-center">

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






        @if($message = Session::get('uploadsuccess'))
                <h1>Crop Profile Picture</h1>

                <h4>(Select area to crop)</h4>
                        <div class="container text-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <img class="img-responsive" src="{{asset('storage/profile_pictures')}}/{{Session::get('imageName')}}" id="target" width="1000px"/>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div id="preview-pane">
                                <div class="preview-container">
                                    <img id="myImg" src="{{asset('storage/profile_pictures')}}/{{Session::get('imageName')}}" class="jcrop-preview" alt="Preview" />
                                </div>
                            </div>
                        </div>
                        <br>
                        <!-- This is the form that our event handler fills -->
                        <form action="{{route('save')}}" method="post" enctype="multipart/form-data" onsubmit="return checkCoords();">
                            {{ csrf_field() }}
                            <input type="hidden" required id="x" name="x" />
                            <input type="hidden" required id="y" name="y" />
                            <input type="hidden" required id="w" name="w" />
                            <input type="hidden" required id="h" name="h" />
                            <input type="hidden" required id="ysize" name="height" />
                            <input type="hidden" required id="xsize" name="width" />
                            <input type="hidden" required value="{{Session::get('imageName')}}" name="imgName">
                            <input type="submit" value="Crop Image" class="btn btn-large btn-danger" />
                        </form>

        @else

        <h1>Update Profile Picture</h1>
        <img src="{{$picture}}" height="300px" class="img-circle" />

        {!! Form::open(array('route' => 'resize','enctype' => 'multipart/form-data')) !!}
        <div class="row">

            <div class="col-md-4 col-md-offset-4">
                <br/>
                {!! Form::file('image', array('class' => 'form-control')) !!}
            </div>
            <div class="col-md-12">
                <br/>
                <button type="submit" class="btn btn-success">Upload Image</button>
            </div>
        </div>
        {!! Form::close() !!}

        @endif
    </div>
@endsection