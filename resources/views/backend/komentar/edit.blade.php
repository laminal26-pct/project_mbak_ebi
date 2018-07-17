@extends('backend.master.app')

@section('title', 'Balas Komentar')

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Balas Komentar</h3>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <th>Produk</th>
              <th>Nama</th>
              <th>Komentar</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$comment->produk->title}}</td>
              <td>{{$comment->name}}</td>
              <td>{!!$comment->description!!}</td>
              <td>{{date('l, d-m-Y H:i', strtotime($comment->created_at))}}</td>
            </tr>
            {!! Form::open(['url' => route('komentar.update',$comment->comment_id), 'method' => 'put'])!!}
            <input type="hidden" name="name" value="{{Auth::user()->name}}">
            <input type="hidden" name="email" value="{{Auth::user()->email}}">
            <tr>
              <td>Komentar</td>
              <td colspan="3">
                {!! Form::textarea('komentar',null, ['class' => 'form-control', 'rows' => '8', 'id' => 'komentar']) !!}
              </td>
            </tr>
            <tr>
              <td></td>
              <td colspan="3">
                {!! Form::button('<i class="fa fa-send"></i>&nbsp;Kirim Komentar', ['class' => 'btn btn-primary','type' => 'submit']) !!}
              </td>
            </tr>
            {!! Form::close()!!}
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection

@section('extra-js')
  <script type="text/javascript">
    tinymce.init({
      selector: '#komentar',
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
