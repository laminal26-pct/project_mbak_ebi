@extends('backend.master.app')

@section('title', 'Detail Relawan')

@section('content')
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Detail Relawan bernama : {{$relawan->nama}}</h3>
    </div>
    <div class="box-body">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <img src="{{asset($relawan->images)}}" alt="" style="width: 250px; height: 250px; border-radius: 125px !important;">
          </div>
          <div class="col-md-6">
            <table class="table">
              <tbody>
                <tr>
                  <td>Nama Relawan : {{$relawan->nama}}</td>
                </tr>
                <tr>
                  <td>Status Relawan : {{$relawan->status}}</td>
                </tr>
                <tr>
                  <td>Tahun Bergabung : {{$relawan->joined}}</td>
                </tr>
                <tr>
                  <td>Alamat Relawan : {{$relawan->alamat}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
