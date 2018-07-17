@extends('frontend.master.app')

@section('title', 'Upload Bukti Pembayaran')

@section('content')
  <div class="main">
    <div class="container">
      <div class="row margin-bottom-40">
        <div class="col-md-12 col-xs-12">
          <h4>Upload Bukti Pembayaran</h4>
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
          {!! Form::open(['url' => route('post.upload',[$email,$kode_order]), 'method' => 'post', 'class' => 'col-md-6', 'enctype' => 'multipart/form-data'])!!}
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
            </div>
            <div class="print-img" style="display:none;">
              <img src="" style="height:300px;width:300px">
            </div>
            <div class="form-group">
              <select class="form-control" name="bank">
                <option value="">Pilih Bank</option>
                @foreach ($bank as $key)
                  <option value="{{$key->bank_id}}" data-id="{{$key->bank_id}}">{{$key->nama_bank}}</option>
                @endforeach
              </select>
            </div>
            <input type="hidden" name="email" value="{{ $email }}" data-email="{{$email}}">
            <input type="hidden" name="kode_order" value="{{ $kode_order }}" data-order="{{$kode_order}}">
            <div class="form-group">
              {!! Form::file('images')!!}
            </div>
            <div class="form-group">
              <button class="btn btn-success upload-image" type="submit">Kirim</button>
            </div>
          {!! Form::close()!!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('extra-js')
  <script type="text/javascript">
    $("body").on("click",".upload-image",function(e){
      $(this).parents("form").ajaxForm(options);
    });

    var options = {
      complete: function(response) {
      	if($.isEmptyObject(response.responseJSON.error)){
          $(".print-img").css('display','block');
          $(".print-img").find('img').attr('src','/uploads/'+response.responseJSON.images);
      		alert('Upload gambar berhasil.');
      	}else{
      		printErrorMsg(response.responseJSON.error);
      	}
      }
    };

    function printErrorMsg (msg) {
  	  $(".print-error-msg").find("ul").html('');
  	  $(".print-error-msg").css('display','block');
  	  $.each( msg, function( key, value ) {
  	    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
  	  });
    }

    (function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.upload-image').on('change', function() {
            var id = $(this).attr('data-id')
            var email = $(this).attr('data-email')
            $.ajax({
              type: "POST",
              url: '{{ url('beranda/upload/bukti-pembayaran/') }}' + '/' + id,
              data: {
                'pengiriman': this.value,
              },
              success: function(data) {
                window.location.href = '{{ route('order.index') }}';
              }
            });

        });
    })();
  </script>
@endsection
