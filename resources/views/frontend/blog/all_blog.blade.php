@extends('frontend/template/main')
@section('title','Home')
@section('container')

<aside>

    @if($posts->count())
    <div class="row">
        <div class="col-md-8">
            <h2 class="text-center mb-4 mt-3">{{ $title }}</h2>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <form action="/blog" method="get">

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search.." name="keyword" value="{{ request('keyword') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    Search
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    
                    @foreach($posts as $post)

                    <h3 class="mt-3">{{ $post->title }}</h3>
                    <p>
                        <i class="fas fa-calendar"></i> {{ $post->published_at }} | <i class="fas fa-user"></i> <a href="#" class="text-decoration-none">{{ $post->user->name }}</a> | <i class="fas fa-eye"></i> {{ $post->view }}
                                       
                    </p>

                    <div class="position-absolute px-3 py-2" style="background-color: rgba(0,0,0,0.7);">
                        <a href="#" class="text-decoration-none text-white">
                            {{ $post->category->name }}
                        </a>
                    </div>

                    @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" width="300" height="1200" class="img-fluid" alt="{{ $post->title }}">
                    @else
                    <img src="https://source.unsplash.com/1200x400/?nature" class="img-fluid" alt="{{ $post->title }}">
                    @endif

                    <article class="my-3">
                        {{ $post->excerpt }} <a href="/blog/detail/{{ $post->slug }}">Read more...</a>
                    </article>
                    
                    @endforeach
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-end"> 
                
            </div>

        </div>
        
        @include('frontend/template/sidebar')

    </div>
    
    @else
    <p class="h3">Belum ada Postingan</p>
    @endif

</aside>
@endsection