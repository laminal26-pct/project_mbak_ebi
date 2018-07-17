@extends('frontend.master.app')

@section('title',$website->nama_web)

@section('content')
  <div class="main">
    <div class="container">
      <!-- BEGIN SIDEBAR & CONTENT -->
      <div class="row margin-bottom-40">
        <!-- BEGIN CONTENT -->
        <div class="col-md-12 col-sm-12" >
          <h1>{{$website->nama_web}}</h1>
          <div class="content-page">
            <div class="row">
              <div class="col-md-12 col-xs-12">
                {!!$website->description!!}
              </div>
            </div>
          </div>
        </div>
        <!-- END CONTENT -->
      </div>
      <!-- END SIDEBAR & CONTENT -->
    </div>
  </div>
@endsection
