@extends('backend.master.app')

@section('title', 'Video')

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Video</h3>
      <div class="pull-right">
        <a href="{{route('video.create')}}" class="btn btn-sm btn-primary">
          <i class="fa fa-upload"></i>&nbsp;Upload Video
        </a>
      </div>
    </div>
    @include('backend.master.flash')
    <div class="box-body">
      <div class="col-md-12">
        <table class="table table-bordered table-hover" id="videotabel">
          <thead>
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php($i = 1)
            @if (count($video) > 0)
              @foreach ($video as $k)
                <tr>
                  <td>{{$i++}}</td>
                  <td>{{$k->title}}</td>
                  <td>{{$k->status}}</td>
                  <td>
                    {!! Form::model($video, ['url' => route('video.destroy',$k->slug), 'method' => 'delete', 'id' => 'formdelete']) !!}
                      <a href="{{route('video.edit',$k->slug)}}" class="btn btn-xs btn-warning">
                        <i class="fa fa-edit"></i>&nbsp;Edit
                      </a>&nbsp;
                      <a href="{{route('video.show',$k->slug)}}" class="btn btn-xs btn-info">
                        <i class="fa fa-list"></i>&nbsp;Detail
                      </a>&nbsp;
                      <button type="submit" class="btn btn-xs btn-danger" id="confirm">
                        <i class="fa fa-trash"></i>&nbsp;Hapus
                      </button>
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="4">Tidak Ada Data</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('extra-js')
  <script type="text/javascript">
    $(function() {
      $('#videotabel').DataTable({'pageLength': 10, columnDefs: [{orderable: false, targets:[3]}]});
      $('#videotabel').find('td[colspan=4]').css('text-align','center');
    });
  </script>
@endsection
