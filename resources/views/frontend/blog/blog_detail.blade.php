@extends('frontend/template/main')
@section('title','Home')
@section('container')

<aside>

    <div class="row">
        <div class="col-md-8">

            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-3">{{ $post->title }}</h2>
                    <p>
                        <i class="fas fa-calendar"></i> {{ $post->published_at }} | <i class="fas fa-user"></i> <a href="#" class="text-decoration-none">{{ $post->user->name }}</a> | <i class="fas fa-eye"></i> 0
                                       
                    </p>

                    @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid" alt="...">
                    @else
                    <img src="https://source.unsplash.com/1200x400/?nature" class="img-fluid" alt="...">
                    @endif

                    <article class="my-3">
                        {!! $post->body !!}
                    </article>
                    

                   
                </div>
            </div>
           

        </div>
        
        @include('frontend/template/sidebar')

    </div>
    
    

</aside>
@endsection