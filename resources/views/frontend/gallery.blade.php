@extends('frontend.master.app')

@section('title', 'Galeri')

@section('content')
  <div class="main" style="min-height:508px">
    <div class="container">
      <div class="row margin-bottom-40">
        <div class="col-md-12 col-xs-12">
          <h2>Galeri Album</h2>
          <div class="content-page">
            <div class="row mix-grid thumbnails">
              @foreach ($album as $k)
                <div class="col-md-3 col-sm-4 mix mix_all" style="display: block; opacity: 1;">
                  <div class="mix-inner">
                     <img alt="{{$k->name}}" src="{{asset('gallery/albums/'.$k->cover)}}" class="img-responsive" style="height: 260px; max-height: 260px; width: 260px;">
                     <div class="mix-details">
                        <h4>{{$k->name}}</h4>
                        <a class="mix-link" href="{{route('home.gallery.photo',$k->album_id)}}"><i class="fa fa-link"></i>&nbsp;Lihat Foto</a>
                        <a data-rel="fancybox-button" title="{{$k->name}}" href="{{asset('gallery/albums/'.$k->cover)}}" class="mix-preview fancybox-button"><i class="fa fa-search"></i>&nbsp; Perbesar</a>
                     </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
