@extends('layouts.app')


@section('content')
        <h1>Trasee Montane în Parcul Național Retezat</h1>
        @if(count($trails) > 0)
                @foreach($trails as $trails)
                <div class="card mb-3" style="max-width: 2000px;">
                        <div class="row no-gutters">
                          <div class="col-md-4">
                                <img class="card-img-top" style="width: 100%" src="/trails_images/{{$trails->trails_image}}" alt="Card image cap">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title">{{$trails->title}}</h5>
                            <p class="card-text"><small class="text-muted">Marcaj: {{$trails->marcaj}}</small></p>
                            <br><br><br><br><br>
                              <a href="/trails/{{$trails->id}}" class="btn btn-primary">View</a>
                            </div>
                          </div>
                        </div>
                </div>
                <br>

                
                @endforeach    
        @else
                <p>No trails found</p>
        @endif
@endsection 

