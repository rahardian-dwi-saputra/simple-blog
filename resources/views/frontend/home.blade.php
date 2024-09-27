@extends('frontend/template/main')
@section('title','Home')
@section('container')

@if($posts->count())
<h3 class="mt-3 mb-3"> Postingan Terpopuler</h3>
<div class="card-group">

  @foreach($posts as $post)

  <div class="card">
    @if($post->image)
    <img src="{{ asset('storage/'.$data->image) }}" class="card-img-top" alt="...">
    @endif
    <div class="card-body">
      <h5 class="card-title">{{ $post->title }}</h5>
      <p class="card-text">{{ $post->excerpt }}</p>
      <p class="card-text">
        <small class="text-muted">Dibaca sebanyak {{ $post->view }} kali</small>
      </p>
      <a href="/blog/detail/{{ $post->slug }}" class="card-link">Selengkapnya...</a>
    </div>
  </div>

  @endforeach

</div>

@if($users->count())
<h3 class="mt-3 mb-3"> Penulis Terbanyak</h3>

<div class="row row-cols-1 row-cols-md-3 g-4 mb-3">

  @foreach($users as $user)

  <div class="col">
    <div class="card text-center p-3">
      <img src="{{ asset('assets/dist/img/default-profil.png') }}" class="img-thumbnail img-fluid rounded-circle mx-auto d-block" alt="user-foto" width="150" height="150">
      <h5 class="card-title mt-1">{{ $user->name }}</h5>
      <p class="card-text">Total Postingan : {{ $user->total }}</p>
    </div>
  </div>

  @endforeach
  
</div>
@endif


@else
<h3 class="mt-3 mb-3"> Postingan Tidak Ditemukan</h3>
@endif

@endsection