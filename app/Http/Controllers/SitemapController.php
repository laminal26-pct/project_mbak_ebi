<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sitemap;

class SitemapController extends Controller
{
    public function index()
    {
      Sitemap::addSitemap(route('sitemap_home'));
      Sitemap::addSitemap(route('sitemap.berita'));
      Sitemap::addSitemap(route('sitemap.produk'));
      Sitemap::addSitemap(route('sitemap.menu'));
      //Sitemap::addSitemap(url('/sitemap/sitemap_home.xml'));
      return Sitemap::index();
    }

    public function home()
    {
      Sitemap::addTag(route('homepage'),date('yesterday'), 'daily', '0.8');
      return Sitemap::render();
    }

    public function berita()
    {
      $berita = \App\Models\Berita::with('category')->get();
      foreach ($berita as $k) {
        Sitemap::addTag(route('berita.detail',$k->slug), $k->updated_at, 'daily', '0.8');
      }
      return Sitemap::render();
    }

    public function produk()
    {
      $produk = \App\Models\Produk::with(['category','comment'])->get();
      foreach ($produk as $k) {
        Sitemap::addTag(route('produk.detail',$k->slug), $k->updated_at, 'daily', '0.8');
      }
      return Sitemap::render();
    }

    public function menu()
    {
      $menu = \App\Models\Website::all();
      return Sitemap::render();
    }
}
