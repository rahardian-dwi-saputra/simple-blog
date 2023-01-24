@extends('frontend/template/main')
@section('title','Home')
@section('container')

<aside>

    @if($posts->count())
    <div class="row">
        <div class="col-md-8">

            <div class="row">
                <div class="col-md-12">
                    @foreach($posts as $post)

                    <h2 class="mt-3">{{ $post->title }}</h2>
                    <p>
                        <i class="fas fa-calendar"></i> {{ $post->published_at }} | <i class="fas fa-user"></i> <a href="#" class="text-decoration-none">{{ $post->user->name }}</a> | <i class="fas fa-eye"></i> 0
                                       
                    </p>

                    <div class="position-absolute px-3 py-2" style="background-color: rgba(0,0,0,0.7);">
                        <a href="#" class="text-decoration-none text-white">
                            {{ $post->category->name }}
                        </a>
                    </div>

                    @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid" alt="...">
                    @else
                    <img src="https://source.unsplash.com/1200x400/?nature" class="img-fluid" alt="...">
                    @endif

                    <article class="my-3">
                        {{ $post->excerpt }} <a href="/blog/detail/{{ $post->slug }}">Read more...</a>
                    </article>
                    
                    @endforeach
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-end"> 
                {{ $posts->links() }}
            </div>

        </div>
        
        @include('frontend/template/sidebar')

    </div>
    
    @else
    <p class="h3">Postingan tidak ditemukan</p>
    @endif

</aside>
@endsection