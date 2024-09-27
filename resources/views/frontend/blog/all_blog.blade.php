@extends('frontend/template/main')
@section('title','Home')
@section('container')

<h2 class="text-center mb-4 mt-3">{{ $title }}</h2>



<div class="card mb-3">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">{{ $posts[0]->title }}</h5>
    <p>
        <small class="text-muted">
            By <a href="#" class="text-decoration-none">{{ $posts[0]->user->name }}</a> in <a href="#" class="text-decoration-none">{{ $posts[0]->category->slug }}</a> {{ $posts[0]->created_at }}
        </small>
    </p>
    <p class="card-text">{{ $posts[0]->excerpt }}</p>
    <a href="#" class="card-link">Selengkapnya</a>
  </div>
</div>
@endsection