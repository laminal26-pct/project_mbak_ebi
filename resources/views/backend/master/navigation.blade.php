@if (Auth::user()->hasRole('superadmin'))
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="{{ set_active('dashboard.admin')}}">
      <a href="{{ route('dashboard.admin')}}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    <li class="treeview {{ set_active('berita.kategori.edit')}} {{ set_active('berita.kategori.index')}} {{ set_active('berita.index')}} {{ set_active('berita.create')}} {{ set_active('berita.show')}} {{ set_active('berita.edit')}}">
      <a href="#">
        <i class="fa fa-newspaper-o"></i> <span>Berita</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{ set_active('berita.kategori.edit')}} {{ set_active('berita.kategori.index')}}">
          <a href="{{ route('berita.kategori.index')}}"><i class="fa fa-circle-o"></i> Kategori Berita</a>
        </li>
        <li class="{{ set_active('berita.index')}} {{ set_active('berita.create')}} {{ set_active('berita.show')}} {{ set_active('berita.edit')}}">
          <a href="{{ route('berita.index')}}"><i class="fa fa-circle-o"></i>
            <span>Daftar Berita</span>
            <span class="pull-right-container">
              <span class="label label-info pull-right">{{count(\App\Models\Berita::where('post_status','Draft')->get())}}</span>
            </span>
          </a>
        </li>
      </ul>
    </li>
    <li class="treeview {{set_active('kontak.index')}} {{set_active('kontak.show')}} {{set_active('produk.kategori')}} {{set_active('produk.kategori.edit')}} {{ set_active('produk.index')}} {{ set_active('produk.edit')}} {{ set_active('produk.show')}} {{set_active('produk.create')}} {{set_active('komentar.index')}} {{set_active('komentar.edit')}} {{set_active('komentar.show')}}">
      <a href="#">
        <i class="fa fa-book"></i> <span>Produk</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{set_active('produk.kategori')}} {{set_active('produk.kategori.edit')}}">
          <a href="{{ route('produk.kategori')}}"><i class="fa fa-circle-o"></i> Kategori Produk</a>
        </li>
        <li class="{{ set_active('produk.index')}} {{ set_active('produk.edit')}} {{ set_active('produk.show')}} {{set_active('produk.create')}}">
          <a href="{{ route('produk.index')}}"><i class="fa fa-circle-o"></i> Daftar Produk</a>
        </li>
        <li class="{{set_active('komentar.index')}} {{set_active('komentar.edit')}} {{set_active('komentar.show')}}">
          <a href="{{ route('komentar.index')}}"><i class="fa fa-comment"></i>
            <span>Komentar</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">{{count(\App\Models\Comment::where('read','0')->get())}}</span>
            </span></a>
        </li>
        <li class="{{set_active('kontak.index')}} {{set_active('kontak.show')}}">
          <a href="{{ route('kontak.index')}}"><i class="fa fa-address-book"></i>
            <span>Kontak</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">{{count(\App\Models\Kontak::where('read','0')->get())}}</span>
            </span></a>
        </li>
      </ul>
    </li>
    <li class="treeview {{ set_active('order.index') }} {{ set_active('order.show') }} {{set_active('konfirmasi.index')}} {{set_active('konfirmasi.show')}} {{set_active('bank.index')}} {{set_active('bank.edit')}} {{set_active('penjualan.index')}} {{set_active('penjualan.show')}}">
      <a href="#">
        <i class="fa fa-shopping-basket"></i> <span>E-Commerce</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{ set_active('order.index') }}{{ set_active('order.show') }}">
          <a href="{{ route('order.index')}}">
            <i class="fa fa-cart-arrow-down"></i>
            <span>Order Request</span>
            <span class="pull-right-container">
              <span class="label label-info pull-right">{{count(\App\Models\Order::where('status_pembayaran','Belum Lunas')->whereOr('read','0')->get())}}</span>
            </span>
          </a>
        </li>
        <li class="{{set_active('konfirmasi.index')}} {{set_active('konfirmasi.show')}}">
          <a href="{{route('konfirmasi.index')}}">
            <i class="fa fa-money"></i>
            <span>Konfirmasi Pembayaran</span>
            <span class="pull-right-container">
              <span class="label label-info pull-right">{{count(\App\Models\Konfirmasi::where('read','0')->get())}}</span>
            </span>
          </a>
        </li>
        <li class="{{set_active('bank.index')}} {{set_active('bank.edit')}}">
          <a href="{{route('bank.index')}}">
            <i class="fa fa-bank"></i> <span>Konfigurasi Bank</span>
          </a>
        </li>
        <li class="{{set_active('penjualan.index')}} {{set_active('penjualan.show')}}">
          <a href="{{route('penjualan.index')}}">
            <i class="fa fa-file-pdf-o"></i> <span>Penjualan</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="{{set_active('albums.index')}} {{set_active('albums.show')}} {{set_active('albums.create')}} {{set_active('photos.create')}}">
      <a href="{{route('albums.index')}}">
        <i class="fa fa-image"></i> <span>Galeri Album Foto</span>
      </a>
    </li>
    <li class="treeview {{set_active('admin.gallery')}} {{set_active('admin.files')}} {{set_active('konfig-web.index')}} {{set_active('konfig-web.edit')}} {{set_active('konfig-web.create')}} {{set_active('konfig-web.show')}} {{set_active('pengguna.index')}} {{set_active('pengguna.create')}} {{set_active('pengguna.edit')}} {{set_active('pengguna.show')}}">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Manajemen</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{set_active('admin.gallery')}}">
          <a href="{{route('admin.gallery')}}">
            <i class="fa fa-picture-o"></i> <span>Manajemen Galeri</span>
          </a>
        </li>
        <li class="{{set_active('admin.files')}}">
          <a href="{{route('admin.files')}}">
            <i class="fa fa-file-o"></i> <span>Manajemen File</span>
          </a>
        </li>
        <li class="{{set_active('pengguna.index')}}{{set_active('pengguna.create')}}{{set_active('pengguna.edit')}}{{set_active('pengguna.show')}}">
          <a href="{{route('pengguna.index')}}">
            <i class="fa fa-users"></i> <span>Manajemen User</span>
          </a>
        </li>
        <li class="{{set_active('konfig-web.index')}}{{set_active('konfig-web.edit')}}{{set_active('konfig-web.create')}}{{set_active('konfig-web.show')}}">
          <a href="{{route('konfig-web.index')}}">
            <i class="fa fa-firefox"></i> <span>Manajemen Website</span>
          </a>
        </li>
      </ul>
    </li>
    <li>
      <a href="{{route('activity')}}">
        <i class="fa fa-tasks"></i>
        <span>Logger</span>
        <span class="pull-right-container">
          <span class="label label-default pull-right">{{count(jeremykenedy\LaravelLogger\App\Models\Activity::all())}}</span>
        </span>
      </a>
    </li>
  </ul>
@elseif (Auth::user()->hasRole('admin'))
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="{{ set_active('dashboard.editor')}}">
      <a href="{{ route('dashboard.editor')}}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    <li class="{{ set_active('berita-editor.index')}} {{ set_active('berita-editor.create')}} {{ set_active('berita-editor.show')}} {{ set_active('berita-editor.edit')}}">
      <a href="{{ route('berita-editor.index')}}">
        <i class="fa fa-newspaper-o"></i> <span>Berita</span>
      </a>
    </li>
  </ul>
@endif
