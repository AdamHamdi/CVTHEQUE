@extends('layouts.app')

@section('content')





<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{url('cvs/'.$cv->id)}}" method="post" enctype="multipart/form-data">

                <input type="hidden" name="_method" value="PUT">

                {{ csrf_field() }}
                <div class="form-group">
                    <label >Titre :</label>
                    <input  class="form-control @if($errors->get('titre')) is-invalid @endif" type="text" name="titre" value="{{ $cv->titre }}" placeholder="Wrap your cv title">

                    @if($errors->get('titre'))

                    @foreach($errors->get('titre') as $message)
                       <label style='color:red'>{{$message}}</label>
                    @endforeach

                 @endif
                </div>
                <div class="form-group">
                    <label >Presentation:</label>
                    <textarea  class="form-control @if($errors->get('presentation')) is-invalid @endif" type="text" name="presentation" placeholder="Wrap the prensentation of your cv">{{ $cv->presentation }}</textarea>

                    @if($errors->get('presentation'))

                    @foreach($errors->get('presentation') as $message)
                       <label style='color:red'>{{$message}}</label>
                    @endforeach

                 @endif

                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input id="" class="form-control" type="file" name="photo">
                </div>

                <div class="form-group">

                    <input  class="form-control btn btn-danger" type="submit" value="Modifier">
                </div>
            </form>

        </div>
    </div>
</div>


@endsection
