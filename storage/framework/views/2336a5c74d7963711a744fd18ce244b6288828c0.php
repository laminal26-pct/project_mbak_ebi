<?php if(Auth::user()->hasRole('superadmin')): ?>
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="<?php echo e(set_active('dashboard.admin')); ?>">
      <a href="<?php echo e(route('dashboard.admin')); ?>">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    <li class="treeview <?php echo e(set_active('berita.kategori.edit')); ?> <?php echo e(set_active('berita.kategori.index')); ?> <?php echo e(set_active('berita.index')); ?> <?php echo e(set_active('berita.create')); ?> <?php echo e(set_active('berita.show')); ?> <?php echo e(set_active('berita.edit')); ?>">
      <a href="#">
        <i class="fa fa-newspaper-o"></i> <span>Berita</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php echo e(set_active('berita.kategori.edit')); ?> <?php echo e(set_active('berita.kategori.index')); ?>">
          <a href="<?php echo e(route('berita.kategori.index')); ?>"><i class="fa fa-circle-o"></i> Kategori Berita</a>
        </li>
        <li class="<?php echo e(set_active('berita.index')); ?> <?php echo e(set_active('berita.create')); ?> <?php echo e(set_active('berita.show')); ?> <?php echo e(set_active('berita.edit')); ?>">
          <a href="<?php echo e(route('berita.index')); ?>"><i class="fa fa-circle-o"></i>
            <span>Daftar Berita</span>
            <span class="pull-right-container">
              <span class="label label-info pull-right"><?php echo e(count(\App\Models\Berita::where('post_status','Draft')->get())); ?></span>
            </span>
          </a>
        </li>
      </ul>
    </li>
    <li class="treeview <?php echo e(set_active('kontak.index')); ?> <?php echo e(set_active('kontak.show')); ?> <?php echo e(set_active('produk.kategori')); ?> <?php echo e(set_active('produk.kategori.edit')); ?> <?php echo e(set_active('produk.index')); ?> <?php echo e(set_active('produk.edit')); ?> <?php echo e(set_active('produk.show')); ?> <?php echo e(set_active('produk.create')); ?> <?php echo e(set_active('komentar.index')); ?> <?php echo e(set_active('komentar.edit')); ?> <?php echo e(set_active('komentar.show')); ?>">
      <a href="#">
        <i class="fa fa-book"></i> <span>Produk</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php echo e(set_active('produk.kategori')); ?> <?php echo e(set_active('produk.kategori.edit')); ?>">
          <a href="<?php echo e(route('produk.kategori')); ?>"><i class="fa fa-circle-o"></i> Kategori Produk</a>
        </li>
        <li class="<?php echo e(set_active('produk.index')); ?> <?php echo e(set_active('produk.edit')); ?> <?php echo e(set_active('produk.show')); ?> <?php echo e(set_active('produk.create')); ?>">
          <a href="<?php echo e(route('produk.index')); ?>"><i class="fa fa-circle-o"></i> Daftar Produk</a>
        </li>
        <li class="<?php echo e(set_active('komentar.index')); ?> <?php echo e(set_active('komentar.edit')); ?> <?php echo e(set_active('komentar.show')); ?>">
          <a href="<?php echo e(route('komentar.index')); ?>"><i class="fa fa-comment"></i>
            <span>Komentar</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"><?php echo e(count(\App\Models\Comment::where('read','0')->get())); ?></span>
            </span></a>
        </li>
        <li class="<?php echo e(set_active('kontak.index')); ?> <?php echo e(set_active('kontak.show')); ?>">
          <a href="<?php echo e(route('kontak.index')); ?>"><i class="fa fa-address-book"></i>
            <span>Kontak</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"><?php echo e(count(\App\Models\Kontak::where('read','0')->get())); ?></span>
            </span></a>
        </li>
      </ul>
    </li>
    <li class="treeview <?php echo e(set_active('order.index')); ?> <?php echo e(set_active('order.show')); ?> <?php echo e(set_active('konfirmasi.index')); ?> <?php echo e(set_active('konfirmasi.show')); ?> <?php echo e(set_active('bank.index')); ?> <?php echo e(set_active('bank.edit')); ?> <?php echo e(set_active('penjualan.index')); ?> <?php echo e(set_active('penjualan.show')); ?>">
      <a href="#">
        <i class="fa fa-shopping-basket"></i> <span>E-Commerce</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php echo e(set_active('order.index')); ?><?php echo e(set_active('order.show')); ?>">
          <a href="<?php echo e(route('order.index')); ?>">
            <i class="fa fa-cart-arrow-down"></i>
            <span>Order Request</span>
            <span class="pull-right-container">
              <span class="label label-info pull-right"><?php echo e(count(\App\Models\Order::where('status_pembayaran','Belum Lunas')->whereOr('read','0')->get())); ?></span>
            </span>
          </a>
        </li>
        <li class="<?php echo e(set_active('konfirmasi.index')); ?> <?php echo e(set_active('konfirmasi.show')); ?>">
          <a href="<?php echo e(route('konfirmasi.index')); ?>">
            <i class="fa fa-money"></i>
            <span>Konfirmasi Pembayaran</span>
            <span class="pull-right-container">
              <span class="label label-info pull-right"><?php echo e(count(\App\Models\Konfirmasi::where('read','0')->get())); ?></span>
            </span>
          </a>
        </li>
        <li class="<?php echo e(set_active('bank.index')); ?> <?php echo e(set_active('bank.edit')); ?>">
          <a href="<?php echo e(route('bank.index')); ?>">
            <i class="fa fa-bank"></i> <span>Konfigurasi Bank</span>
          </a>
        </li>
        <li class="<?php echo e(set_active('penjualan.index')); ?> <?php echo e(set_active('penjualan.show')); ?>">
          <a href="<?php echo e(route('penjualan.index')); ?>">
            <i class="fa fa-file-pdf-o"></i> <span>Penjualan</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="<?php echo e(set_active('albums.index')); ?> <?php echo e(set_active('albums.show')); ?> <?php echo e(set_active('albums.create')); ?> <?php echo e(set_active('photos.create')); ?>">
      <a href="<?php echo e(route('albums.index')); ?>">
        <i class="fa fa-image"></i> <span>Galeri Album Foto</span>
      </a>
    </li>
    <li class="treeview <?php echo e(set_active('admin.gallery')); ?> <?php echo e(set_active('admin.files')); ?> <?php echo e(set_active('konfig-web.index')); ?> <?php echo e(set_active('konfig-web.edit')); ?> <?php echo e(set_active('konfig-web.create')); ?> <?php echo e(set_active('konfig-web.show')); ?> <?php echo e(set_active('pengguna.index')); ?> <?php echo e(set_active('pengguna.create')); ?> <?php echo e(set_active('pengguna.edit')); ?> <?php echo e(set_active('pengguna.show')); ?>">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>Manajemen</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="<?php echo e(set_active('admin.gallery')); ?>">
          <a href="<?php echo e(route('admin.gallery')); ?>">
            <i class="fa fa-picture-o"></i> <span>Manajemen Galeri</span>
          </a>
        </li>
        <li class="<?php echo e(set_active('admin.files')); ?>">
          <a href="<?php echo e(route('admin.files')); ?>">
            <i class="fa fa-file-o"></i> <span>Manajemen File</span>
          </a>
        </li>
        <li class="<?php echo e(set_active('pengguna.index')); ?><?php echo e(set_active('pengguna.create')); ?><?php echo e(set_active('pengguna.edit')); ?><?php echo e(set_active('pengguna.show')); ?>">
          <a href="<?php echo e(route('pengguna.index')); ?>">
            <i class="fa fa-users"></i> <span>Manajemen User</span>
          </a>
        </li>
        <li class="<?php echo e(set_active('konfig-web.index')); ?><?php echo e(set_active('konfig-web.edit')); ?><?php echo e(set_active('konfig-web.create')); ?><?php echo e(set_active('konfig-web.show')); ?>">
          <a href="<?php echo e(route('konfig-web.index')); ?>">
            <i class="fa fa-firefox"></i> <span>Manajemen Website</span>
          </a>
        </li>
      </ul>
    </li>
    <li class="<?php echo e(set_active('info-relawan.index')); ?> <?php echo e(set_active('info-relawan.create')); ?> <?php echo e(set_active('info-relawan.edit')); ?> <?php echo e(set_active('info-relawan.show')); ?>">
      <a href="<?php echo e(route('info-relawan.index')); ?>">
        <i class="fa fa-users"></i>
        <span>Info Relawan</span>
      </a>
    </li>
    <li class="<?php echo e(set_active('video.index')); ?> <?php echo e(set_active('video.create')); ?> <?php echo e(set_active('video.edit')); ?> <?php echo e(set_active('video.show')); ?>">
      <a href="<?php echo e(route('video.index')); ?>">
        <i class="fa fa-video-camera"></i>
        <span>Video</span>
      </a>
    </li>
    <li>
      <a href="<?php echo e(route('activity')); ?>">
        <i class="fa fa-tasks"></i>
        <span>Logger</span>
        <span class="pull-right-container">
          <span class="label label-default pull-right"><?php echo e(count(jeremykenedy\LaravelLogger\App\Models\Activity::all())); ?></span>
        </span>
      </a>
    </li>
  </ul>
<?php elseif(Auth::user()->hasRole('admin')): ?>
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="<?php echo e(set_active('dashboard.editor')); ?>">
      <a href="<?php echo e(route('dashboard.editor')); ?>">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    <li class="<?php echo e(set_active('berita-editor.index')); ?> <?php echo e(set_active('berita-editor.create')); ?> <?php echo e(set_active('berita-editor.show')); ?> <?php echo e(set_active('berita-editor.edit')); ?>">
      <a href="<?php echo e(route('berita-editor.index')); ?>">
        <i class="fa fa-newspaper-o"></i> <span>Berita</span>
      </a>
    </li>
  </ul>
<?php endif; ?>
