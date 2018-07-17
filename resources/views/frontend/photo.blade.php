@extends('frontend.master.app')

@section('title', 'Album Foto '.$album->name)

@section('content')
  <div class="main" style="min-height:508px">
    <div class="container">
      <div class="row margin-bottom-40">
        <div class="col-md-12 col-xs-12">
          <h2>Galeri Album {{$album->name}}</h2>
          <div class="content-page">
            <div class="row margin-bottom-40">
              @foreach ($album->photos as $k)
                <div class="col-md-3 col-sm-4 gallery-item">
                  <a data-rel="fancybox-button" title="{{$k->description}}" href="{{asset('gallery/photos/'.$k->image)}}" class="fancybox-button">
                    <img alt="{{$k->name}}" src="{{asset('gallery/photos/'.$k->image)}}" class="img-responsive" style="height: 200px;max-width: 100%;max-height: 200px;">
                    <div class="zoomix"><i class="fa fa-search"></i></div>
                  </a>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
