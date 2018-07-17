@extends('backend.master.app')

@section('title', 'Detail Berita')

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Detail Berita</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-condensed">
          <tbody>
            <tr>
              <td style="width: 100px;">Judul Berita</td>
              <td>{!!$news->title!!}</td>
            </tr>
            <tr>
              <td>Author</td>
              <td>{!!$news->name!!}</td>
            </tr>
            <tr>
              <td>Kategori</td>
              <td>{!!$news->nama_kategori_berita!!}</td>
            </tr>
            <tr>
              <td>Status Posting</td>
              <td>{!!$news->post_status!!}</td>
            </tr>
            <tr>
              <td>Headline</td>
              <td>{!!$news->headline!!}</td>
            </tr>
            <tr>
              <td colspan="2"><img src="{{ asset($news->images) }}" alt="" width="250px" height="250px"></td>
            </tr>
            <tr>
              <td>Tanggal</td>
              <td>{!! date('d-F-Y', strtotime($news->created_at)) !!}</td>
            </tr>
            <tr>
              <td colspan="2">{!!$news->description!!}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection
