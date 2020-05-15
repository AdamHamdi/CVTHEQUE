@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">



            <h1> La liste de mes Cvs:</h1>
            <br><br>
            <div class="float-right">
                <a href="{{url('cvs/create')}}" class="btn btn-success">Nouveau</a>
            </div>
            <div class="row">

            @foreach($cvs as $cv)
             <div class="col-md-4 ">


            <div class="card" style="width: 20rem;">
                <img src="{{ asset('storage/'.$cv->photo) }}" class="card-img-top img-thumbnail "  style="width:100%; height:180%">
                <div class="card-body">
                  <h5 class="">{{ $cv->titre }}<br></h5><h6>{{ $cv->user->name }}</h6>
                  <h6 class="">{{ $cv->presentation }}</h6><hr>
                  <p class="">
                    <form action="{{url('cvs/'.$cv->id)}}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <a href="{{url('cvs/'.$cv->id)}}" class="btn btn-primary">Details</a>

                        <a href="{{url('cvs/'.$cv->id.'/edit')}}" class="btn btn-secondary">Editer</a>

                        @can('delete', $cv)
                        <button type="submit" class="btn btn-danger ">Supprimer</button>
                        @endcan

                    </form>
                  </p>
                </div>
            </div>
           </div>
            @endforeach
            <br>
        </div>




    </div>
</div>

@endsection
