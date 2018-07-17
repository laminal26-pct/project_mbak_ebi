@extends('frontend.master.app')

@section('title', $product->title)

@section('content')
  <div class="main">
    <div class="container">
      <!-- BEGIN SIDEBAR & CONTENT -->
      <div class="row margin-bottom-40">
        <!-- BEGIN CONTENT -->
        <div class="col-md-12 col-sm-12">
          <h1>{{$product->title}}</h1>
          <div class="content-page">
            <div class="row">
              <!-- BEGIN LEFT SIDEBAR -->
              <div class="col-md-9 col-sm-9 blog-item">
                <ul class="blog-info">
                  <li><i class="fa fa-money"></i> Rp. {{number_format($product->harga,0,",",".")}}</li>
                  <li><i class="fa fa-database"></i> {{$product->stock}}</li>
                  <li><i class="fa fa-tag"></i> {{$product->category->nama_kategori_produk}}</li>
                </ul>
                <div class="blog-item-img">
                  <img src="{{asset($product->images)}}" alt="Gambar" style="height: 300px;">
                </div>
                <div style="margin: 10px 0 10px 0;">
                  {!! Form::open(['url' => route('cart.store'), 'method' => 'post']) !!}
                    <input type="hidden" name="produk_id" value="{{ $product->produk_id }}">
                    <input type="hidden" name="title" value="{{ $product->title }}">
                    <input type="hidden" name="harga" value="{{ $product->harga }}">
                    <button type="submit" style="float: none; color: white;" class="btn btn-success col-md-4">
                      <i class="fa fa-money"></i>&nbsp;Beli
                    </button>
                    <a href="{{route('home.kontak.create')}}" class="btn btn-warning col-md-4" style="float: none; color: white;"><i class="fa fa-info"></i> Kontak Kami</a>
                  {!! Form::close() !!}
                </div>
                {!! $product->description !!}
                <hr>
                <h2>Komentar</h2>
                <div class="comments">
                  @if (count($comment) > 0)
                    @foreach ($comment as $k)
                      <div class="media" style="padding-bottom: 10px;">
                        <a href="javascript:;" class="pull-left">
                        <img src="{{asset('assets/dist/img/avatar5.png')}}" alt="" class="media-object">
                        </a>
                        <div class="media-body">
                          <h4 class="media-heading">{{$k->name}} <span>{{date('l, d-m-Y H:i:s', strtotime($k->created_at))}} </span></h4>
                          {!!$k->description!!}
                        </div>
                      </div>
                    @endforeach
                  @else
                    <div class="media">
                      <a href="javascript:;" class="pull-left">
                      </a>
                      <div class="media-body text-center">
                        <p>Tidak Ada Komentar</p>
                      </div>
                    </div>
                  @endif

                  <!--end media-->
                </div>

                <div class="post-comment padding-top-40">
                  <h3>Tinggalkan Komentar</h3>
                  {!! Form::open(['url' => route('produk.komen',$product->slug), 'method' => 'post', 'role' => 'form'])!!}
                    <div class="form-group">
                      {!! Form::label('name','Nama')!!}
                      {!! Form::text('name',null, ['class' => 'form-control', 'placeholder' => 'Nama'])!!}
                    </div>
                    <div class="form-group">
                      <label>Email <span class="color-red">*</span></label>
                      {!! Form::text('email',null, ['class' => 'form-control', 'placeholder' => 'Email'])!!}
                    </div>
                    <div class="form-group">
                      {!! Form::label('description','Pesan')!!}
                      {!! Form::textarea('description',null, ['class' => 'form-control', 'rows' => '8']) !!}
                    </div>
                    <p>
                      {!! Form::button('<i class="fa fa-send"></i>&nbsp;Kirim Komentar', ['class' => 'btn btn-primary','type' => 'submit']) !!}
                    </p>
                  {!! Form::close()!!}
                </div>
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

@section('extra-js')
  <script src="{{ asset('assets/plugins/tinymce/js/tinymce/jquery.tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
  <script>
    (function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    })();

    swal('Notifikasi',"Pemesanan diluar kota palembang, harap menghubungi admin dibagian kontak kami",'info', {
      buttons: {
        cancel: "Tutup",
        kontak: "Kontak Admin",
      },
    })
    .then((value) => {
      switch (value) {

        case "kontak":
          window.location.href = '{{route('home.kontak.create')}}';
          break;

        case "catch":
          swal("Gotcha!", "Pikachu was caught!", "success");
          break;

        default:
          swal("Selamat Berbelanja");
      }
    });
  </script>
  <script type="text/javascript">
    tinymce.init({
      selector: '#description',
      height: 150,
      menubar: false,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media contextmenu paste code wordcount'
      ],
      toolbar: 'insert | undo redo | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
      content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css']
    });
  </script>
@endsection
