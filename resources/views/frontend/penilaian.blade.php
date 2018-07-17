@extends('frontend.master.app')

@section('title', 'Penilaian')

@section('css')
  <link rel="stylesheet" href="{{asset('assets/plugins/rating/star-rating.css')}}">
@endsection

@section('js')
  <script src="{{asset('assets/plugins/rating/star-rating.js')}}"></script>
@endsection

@section('content')
  <div class="main">
    <div class="container">
      <div class="row margin-bottom-40">
        <div class="col-md-12 col-xs-12">
          @if (session()->has('success_message'))
              <div class="alert alert-success">
                  {{ session()->get('success_message') }}
              </div>
          @endif

          @if (session()->has('error_message'))
              <div class="alert alert-danger">
                  {{ session()->get('error_message') }}
              </div>
          @endif
          <div class="col-md-6 col-xs-6 col-md-offset-3">
            <div class="text-center">
              <table class="table">
                <tbody>
                  <tr>
                    <td>Kode Transaksi</td>
                    <td>{{$cek->kode_order}}</td>
                  </tr>
                  <tr>
                    <td>Nama Pemesan</td>
                    <td>{{$cek->nama}}</td>
                  </tr>
                </tbody>
              </table>
              <div>
                <h4>Beri Nilai</h4>
                {!! Form::open(['url' => route('penilaian',$cek->kode_order),'method' => 'post', 'class' => 'form-horizontal'])!!}
                  <input id="rating-input" name="rating_input" type="text" title=""/>
                  <input type="hidden" name="kode_order" class="kodeorder" value="{{$cek->kode_order}}">
                  <button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-send"></i> Submit</button>
                {!! Form::close() !!}
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('extra-js')
  <script type="text/javascript">
    (function() {
      var $inp = $('#rating-input');

  		//$inp.attr('value','4');

  		$inp.rating({
                  min: 1,
                  max: 5,
                  step: 1,
                  size: 'md',
                  showClear: false
              });
    })();
  </script>
@endsection
