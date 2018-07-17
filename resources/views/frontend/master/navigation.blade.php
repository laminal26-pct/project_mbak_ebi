<!-- BEGIN NAVIGATION -->
<div class="header-navigation pull-right font-transform-inherit">
  <ul>
    <li class="{{ set_active('homepage')}} {{set_active('berita.detail')}} {{set_active('berita.kategori')}}"><a href="{{ route('homepage')}}">Beranda</a></li>
    <li class="dropdown {{ set_active('profil.rbc')}} {{ set_active('profil.pedado')}}">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="#">Profil</a>
      <ul class="dropdown-menu">
        <li class="{{ set_active('profil.rbc')}}"><a href="{{ route('profil.rbc')}}">RBC</a></li>
        <li class="{{ set_active('profil.pedado')}}"><a href="{{ route('profil.pedado')}}">PEDADO</a></li>
      </ul>
    </li>
    <li class="dropdown {{ set_active('program.rmh')}} {{ set_active('program.hydro')}} {{ set_active('program.pendidikan')}}">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="#">Program RBC</a>
      <ul class="dropdown-menu">
        <li class="{{ set_active('program.rmh')}}"><a href="{{ route('program.rmh')}}">Rumah Jamur</a></li>
        <li class="{{ set_active('program.hydro')}}"><a href="{{ route('program.hydro')}}">Hydropolik</a></li>
        <li class="{{ set_active('program.pendidikan')}}"><a href="{{ route('program.pendidikan')}}">Pendidikan</a></li>
      </ul>
    </li>
    <li class="dropdown {{ set_active('ukm.katur')}}{{ set_active('ukm.kar')}}{{ set_active('ukm.lampu')}}">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-target="#">UKM</a>
      <ul class="dropdown-menu">
        <li class="{{ set_active('ukm.katur')}}"><a href="{{ route('ukm.katur')}}">Katur Lihab</a></li>
        <li class="{{ set_active('ukm.kar')}}"><a href="{{ route('ukm.kar')}}">Kar Flanet</a></li>
        <li class="{{ set_active('ukm.lampu')}}"><a href="{{ route('ukm.lampu')}}">Lampu Hias</a></li>
      </ul>
    </li>
    <li class="{{ set_active('produk.list')}} {{ set_active('produk.detail')}} {{ set_active('produk.form')}} {{set_active('produk.kategori.home')}}"><a href="{{ route('produk.list')}}">Produk</a></li>
    <li class="{{ set_active('home.gallery')}} {{ set_active('home.gallery.photo')}}"><a href="{{ route('home.gallery')}}">Galeri</a></li>
    <li class="{{ set_active('home.maps')}}"><a href="{{ route('home.maps')}}">Peta Lokasi</a></li>
    <li class="{{ set_active('cart.index')}}"><a href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart"></i>&nbsp;({{ Cart::instance('default')->count(false) }})</a></li>
  </ul>
</div>
<!-- END NAVIGATION -->
