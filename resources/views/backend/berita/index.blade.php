@extends('backend.master.app')

@section('title', 'Daftar Berita')

{{--@section('breadcrumb', breadcrumb::render('dashboard.admin.berita'))--}}

@section('content')
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Berita</h3>
      <div class="pull-right">
        @if (Auth::user()->hasRole('superadmin'))
          <a href="{{ route('berita.create')}}" class="btn btn-sm btn-primary">
            <i class="fa fa-plus"></i>&nbsp;Tambah Berita
          </a>
        @else
          <a href="{{ route('berita-editor.create')}}" class="btn btn-sm btn-primary">
            <i class="fa fa-plus"></i>&nbsp;Tambah Berita
          </a>
        @endif
      </div>
      @include('backend.master.flash')
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="beritatable">
            <thead style="background-color: #ccc; color: #222;">
              <tr>
                <th style="width: 50px; text-align: center;">No.</th>
                <th style="text-align: center;">Judul Berita</th>
                <th style="text-align: center; width: 150px;">Author</th>
                <th style="text-align: center; width: 70px;">Status</th>
                <th style="text-align: center;">Kategori</th>
                <th style="text-align: center; width: 210px;">Action</th>
              </tr>
            </thead>
            <tbody>
              @php($i = 1)
              @if (count($news) > 0)
                @foreach ($news as $k)
                  <tr>
                    <td>{{$i++}}.</td>
                    <td>{{$k->title}}</td>
                    <td>{{$k->name}}</td>
                    <td>
                      @if (Auth::user()->hasRole('superadmin'))
                        @if ($k->post_status == "Publikasi")
                          <span class="label label-success">{{$k->post_status}}</span>
                        @else
                          <select class="poststatus" name="poststatus" data-id="{{$k->berita_id}}">
                            <option {{$k->post_status == "Draft" ? 'selected' : ''}}>Draft</option>
                            <option {{$k->post_status == "Publikasi" ? 'selected' : ''}} value="publikasi">Publish</option>
                          </select>
                        @endif
                      @else
                        <span class="label label-success">{{$k->post_status}}</span>
                      @endif
                    </td>
                    <td>{{$k->nama_kategori_berita}}</td>
                    <td>
                      @if (Auth::user()->hasRole('superadmin'))
                        {!! Form::model($news, ['url' => route('berita.destroy',$k->berita_id), 'method'=>'delete', 'id' => 'formdelete']) !!}
                        <a href="{{ route('berita.edit',$k->berita_id)}}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</a> &nbsp;
                        <a href="{{ route('berita.show',$k->berita_id)}}" class="btn btn-xs btn-info"><i class="fa fa-list"></i>&nbsp;Detail</a> &nbsp;
                        <button type="submit" class="btn btn-xs btn-danger" id="confirm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                        {!! Form::close() !!}
                      @else
                        {!! Form::model($news, ['url' => route('berita-editor.destroy',$k->berita_id), 'method'=>'delete', 'id' => 'formdelete']) !!}
                        <a href="{{ route('berita-editor.edit',$k->berita_id)}}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</a> &nbsp;
                        <a href="{{ route('berita-editor.show',$k->berita_id)}}" class="btn btn-xs btn-info"><i class="fa fa-list"></i>&nbsp;Detail</a> &nbsp;
                        <button type="submit" class="btn btn-xs btn-danger" id="confirm"><i class="fa fa-trash"></i>&nbsp;Hapus</button>
                        {!! Form::close() !!}
                      @endif
                    </td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="6" style="text-align: center;">Tidak Ada Data</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection

@if (Auth::user()->hasRole('superadmin'))
  @section('extra-js')
    <script>
      (function() {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $('.poststatus').on('change', function() {
          var id = $(this).attr('data-id')
          $.ajax({
            type: "PATCH",
            url: '{{ url('dashboard/administrator/berita/update/poststatus/publish')}}' + '/' + id,
            data: {
              'post_status': this.value,
            },
            success: function (data) {
              window.location.href = '{{route('berita.index')}}'
            }
          });
        });
      })();
    </script>
  @endsection
@endif
