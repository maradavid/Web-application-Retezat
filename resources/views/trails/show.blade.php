@extends('layouts.app') 

@section('content')
    
        <a href="/trails" class="btn btn-light">Go back</a>
        <h1>{{$trails->title}}</h1>
        <img style="width: 70rem" src="/trails_images/{{$trails->trails_image}}">
        <br>
        <div>Marcaj: {{$trails->marcaj}}</div>
        <div>
            {!!$trails->body!!}
        </div>
        
    
    
@endsection

