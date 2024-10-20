@extends('frontend/template/main')
@section('title','Home')
@section('container')

@if($posts->count())
<h3 class="mt-3 mb-3"> Postingan Terpopuler</h3>
<div class="card-group">

  @foreach($posts as $post)

  <div class="card">
    @if($post->image)
    <img src="{{ asset('storage/'.$data->image) }}" class="card-img-top" alt="image post" height="200">
    @else
    <img src="https://picsum.photos/200/300?random={{ $loop->iteration }}" class="card-img-top" alt="Image post" height="200">
    @endif
    <div class="card-body">
      <h5 class="card-title"><a href="/blog/detail/{{ $post->slug }}" class="text-decoration-none text-dark">{{ $post->title }}</a></h5>
      <p class="card-text">
        <small class="text-muted">Dibaca sebanyak {{ $post->view }} kali</small>
      </p>
      <p class="card-text">{{ $post->excerpt }}</p>
      <a href="/blog/detail/{{ $post->slug }}" class="btn btn-primary">Selengkapnya</a>
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
      @if($user->foto)
      <img src="{{ asset('storage/'.$user->foto) }}" class="img-thumbnail img-fluid rounded-circle mx-auto d-block" alt="user-foto" width="150" height="150">
      @else
      <img src="{{ asset('assets/dist/img/default-profil.png') }}" class="img-thumbnail img-fluid rounded-circle mx-auto d-block" alt="user-foto" width="150" height="150">
      @endif

      <h5 class="card-title mt-1"><a href="/blog/user/{{ $user->username }}" class="text-decoration-none text-dark">{{ $user->name }}</a></h5>
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