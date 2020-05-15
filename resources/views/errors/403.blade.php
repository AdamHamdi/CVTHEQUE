@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2 text-center">
            <h2>This page is unauthorized !</h2>
            <a href="{{url('cvs')}}">Retour</a>
        </div>
    </div>
</div>
@endsection

