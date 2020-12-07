@extends('layouts.app') 

@section('content')
    <h1>Experiențele vizitatorilor în Parcul Național Retezat</h1>

    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="card card-body bg-light">
                <div class="row no-gutters">
                    <div class="col-md-4 col-sm-4">
                        <img style="width: 20rem; height: 15rem;" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    
                    <div class="col-md-8 col-sm-8">
                        <h1><a href="/posts/{{$post->id}}">{{$post->title}}</a></h1>
                        <small>Written on {{$post->created_at}}  by {{$post->user['name']}}</small>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found</P>
    @endif
@endsection