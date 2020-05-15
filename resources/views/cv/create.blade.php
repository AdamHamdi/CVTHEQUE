@extends('layouts.app')

@section('content')





<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="{{url('cvs')}}" method="post" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="form-group ">
                    <label >Titre :</label>
                    <input  class="form-control  @if($errors->get('titre')) is-invalid @endif" type="text" id = "inputError" name="titre" value="{{old('titre')}}" placeholder="Wrap your cv title">
                    @if($errors->get('titre'))

                       @foreach($errors->get('titre') as $message)
                          <label class='text-danger' for = "inputError">{{$message}}</label>
                       @endforeach

                    @endif
                </div>
                <div class="form-group ">
                    <label >Presentation:</label>

                    <textarea  class="form-control @if($errors->get('presentation')) is-invalid @endif" type="text"  name="presentation" placeholder="Wrap the presentation of your cv">{{old('presentation')}}</textarea>
                    @if($errors->get('presentation'))

                    @foreach($errors->get('presentation') as $message)
                       <label class='text-danger'>{{$message}}</label>
                    @endforeach

                 @endif

                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input id="" class="form-control" type="file" name="photo">
                </div>

                <div class="form-group">

                    <input  class="form-control btn btn-primary" type="submit" value="Enregistrer">
                </div>
            </form>

        </div>
    </div>
</div>


@endsection
