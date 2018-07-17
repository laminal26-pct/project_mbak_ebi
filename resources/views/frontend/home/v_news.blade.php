@extends('frontend.master.app')

@section('title', $news->title)

@section('content')
  <div class="main">
    <div class="container">
      <!-- BEGIN SIDEBAR & CONTENT -->
      <div class="row margin-bottom-40">
        <!-- BEGIN CONTENT -->
        <div class="col-md-12 col-sm-12" style="min-height: 203px;">
          <h1>{{$news->title}}</h1>
          <div class="content-page">
            <div class="row">
              <!-- BEGIN LEFT SIDEBAR -->
              <div class="col-md-9 col-sm-9 blog-item">
                <ul class="blog-info">
                  <li><i class="fa fa-user"></i> {{$news->name}}</li>
                  <li><i class="fa fa-calendar"></i> {{ date('d/F/Y', strtotime($news->created_at))}}</li>
                  <li><i class="fa fa-tags"></i> {{$news->nama_kategori_berita}}</li>
                </ul>
                <div class="blog-item-img">
                  <!-- BEGIN CAROUSEL -->
                  <div class="front-carousel">
                    <div id="myCarousel" class="carousel slide">
                      <!-- Carousel items -->
                      <div class="carousel-inner">
                        <div class="item active">
                          <img src="{{ asset($news->images)}}" alt="{{$news->title}}" style="max-height: 300px; max-width: 100%;">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- END CAROUSEL -->
                </div>
                {!! $news->description !!}
              </div>
              <!-- END LEFT SIDEBAR -->
            </div>
          </div>
        </div>
        <!-- END CONTENT -->
      </div>
      <!-- END SIDEBAR & CONTENT -->
    </div>
  </div>
@endsection
