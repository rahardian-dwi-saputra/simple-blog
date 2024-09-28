@extends('frontend/template/main')
@section('title','Blog')
@section('container')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mt-3 mb-3 text-center">{{ $post->title }}</h2>
                <p>
                    <i class="fas fa-calendar"></i> {{ $post->created_at }} | <i class="fas fa-user"></i> <a href="#" class="text-decoration-none">{{ $post->user->name }}</a> | <i class="fas fa-eye"></i> {{ $post->view }}
                                       
                </p>

                <div class="position-absolute px-3 py-2" style="background-color: rgba(0,0,0,0.7);">
                    <a href="#" class="text-decoration-none text-white">
                        {{ $post->category->name }}
                    </a>
                </div>

                    @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid" alt="{{ $post->title }}">
                    @else
                    <img src="https://picsum.photos/1200/400?random=1" class="img-fluid" alt="Image post">
                    @endif

                    <article class="my-3 text-justify fs-5">
                        {!! $post->body !!}
                    </article>
                    
                    <a href="/blog" class="btn btn-primary mb-3">Back to Blog</a>
                    
              
            

        </div>
        
       
    </div>
</div>
@endsection