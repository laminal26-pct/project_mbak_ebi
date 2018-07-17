@extends('frontend.master.app')

@section('title', 'Peta Lokasi')

@section('content')
  <div class="main">
    <div class="container">
      <div class="row margin-bottom-40">
        <div class="col-md-12 col-xs-12">
          <h2>Peta Lokasi <b>Rumah Belajar Ceria Palembang</b></h2>
          <div class="content-page">
            <div class="row">
              <div class="col-md-12">
                <p style="text-size: 13px;"><span><b>Alamat</b> :</span> Jl. H. Sarkowi. B, Keramasan, Kertapati, Kota Palembang, Sumatera Selatan 30141.</p>
                <p><span><b>Telepon</b> :</span> 08117470825</p>
              </div>
              <div class="col-md-12">
                <div id="map" class="gmaps margin-bottom-40" style="height:350px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('extra-js')
  <script>
      function initMap() {
        var uluru = {lat: -3.02765, lng: 104.7251637};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 19,
          center: uluru,
          mapTypeId:google.maps.MapTypeId.ROADMAP
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
          icon: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
          animation: google.maps.Animation.BOUNCE,
          title: 'Kampung Pedado'
        });
        var infowindow = new google.maps.InfoWindow({
          content: "<b>Kampung Pedado.</b> Jl. H. Sarkowi. B, Keramasan, Kertapati, Kota Palembang, Sumatera Selatan 30141. Telepon 08117470825."
        });

        infowindow.open(map,marker);
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD5yRE1jrBhAP4zm87Li8wioquLVGLKr98&callback=initMap"></script>
@endsection
