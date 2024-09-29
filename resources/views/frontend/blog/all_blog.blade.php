@extends('frontend/template/main')
@section('title','Home')
@section('container')

<h2 class="text-center mb-3 mt-3">{{ $title }}</h2>

<div class="row justify-content-center mb-3">
   <div class="col-md-6">
      <form action="/blog">
         <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
         </div>
      </form>
   </div>
</div>

@if($posts->count())
<div class="card mb-3">
   <div class="position-absolute px-3 py-2" style="background-color: rgba(0,0,0,0.7);">
      <a href="/blog/category/{{ $posts[0]->category->slug }}" class="text-white text-decoration-none">{{ $posts[0]->category->slug }}</a>
   </div>
   @if($posts[0]->image)
   <img src="{{ asset('storage/'.$posts[0]->image) }}" class="card-img-top" alt="...">
   @else
   <img src="https://picsum.photos/1200/400?random=1" class="card-img-top" alt="Image post">
   @endif
   <div class="card-body">
      <h5 class="card-title">
         <a href="/blog/detail/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a>
      </h5>
      <p>
         <small class="text-muted">
            <i class="fas fa-user"></i> <a href="/blog/user/{{ $posts[0]->user->username }}" class="text-decoration-none">{{ $posts[0]->user->name }}</a> | <i class="fas fa-eye"></i> {{ $posts[0]->view }} | <i class="fas fa-clock"></i> {{ $posts[0]->created_at->diffForHumans() }}
         </small>
      </p>
      <p class="card-text">{{ $posts[0]->excerpt }}</p>
      <a href="/blog/detail/{{ $posts[0]->slug }}" class="btn btn-primary">Selengkapnya</a>
   </div>
</div>

<div class="container">
   <div class="row">

      @foreach($posts->skip(1) as $post)
      <div class="col-md-4 mb-3">
         <div class="card">
            <div class="position-absolute px-3 py-2" style="background-color: rgba(0,0,0,0.7);">
               <a href="/blog/category/{{ $post->category->slug }}" class="text-white text-decoration-none">{{ $post->category->name }}</a>
            </div>
            @if($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" class="card-img-top" alt="...">
            @else
            <img src="https://picsum.photos/500/400?random={{ $loop->iteration }}" class="card-img-top" alt="Image post">
            @endif
            <div class="card-body">
               <h5 class="card-title">
                  <a href="/blog/detail/{{ $post->slug }}" class="text-decoration-none text-dark">{{ $post->title }}</a>
               </h5>
               <p>
                  <small class="text-muted">
                     <i class="fas fa-user"></i> <a href="/blog/user/{{ $post->user->username }}" class="text-decoration-none">{{ $post->user->name }}</a> | <i class="fas fa-eye"></i> {{ $post->view }} | <i class="fas fa-clock"></i> {{ $post->created_at->diffForHumans() }}
                  </small>
               </p>
               <p class="card-text">{{ $post->excerpt }}</p>
               <a href="/blog/detail/{{ $post->slug }}" class="btn btn-primary">Selengkapnya</a>
            </div>
         </div>
      </div>
      @endforeach
   </div>
</div>
@else
<p class="fs-4 text-center">Postingan Tidak Ditemukan</p>
@endif 

@endsection