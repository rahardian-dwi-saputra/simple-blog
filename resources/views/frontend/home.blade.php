@extends('frontend/template/main')
@section('title','Home')
@section('container')

<aside>

    @if($posts->count())
    <div class="row">
        <div class="col-md-8">

            <div class="row">
                <div class="col-md-12">

                    <div id="carousel" class="carousel slide mt-3 mb-3" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($posts as $post)
                                @if($loop->iteration == 4)
                                    @break
                                @endif
                                <li data-target="#carousel" data-slide-to="{{ $loop->index }}" @if ($loop->first) class="active" @endif></li>   
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach($posts as $post)
                                @if($loop->iteration == 4)
                                    @break
                                @endif
                            <div class="carousel-item @if($loop->first) active @endif">

                                <div class="position-absolute px-3 py-2" style="background-color: rgba(0,0,0,0.7);">
                                    <a href="#" class="text-decoration-none text-white">
                                        {{ $post->category->name }}
                                    </a>
                                </div>

                                @if($post->image)
                                <img src="{{ asset('storage/'.$post->image) }}" class="d-block w-100" alt="...">
                                @else
                                <img src="https://source.unsplash.com/1200x600/?nature" class="d-block w-100" alt="...">
                                @endif

                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{ $post->title }}</h5>
                                    <p>
                                        <small>
                                            <i class="fas fa-calendar"></i> 
                                            {{ $post->published_at }} | <i class="fas fa-user"></i> <a href="#" class="text-decoration-none text-white">{{ $post->user->name }}</a>
                                            
                                        </small>
                                    </p>
                                    <p>{{ $post->excerpt }}</p>
                                    <a href="#" class="text-decoration-none btn btn-primary">Read More</a>
                                </div>

                            </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-target="#carousel" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-target="#carousel" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </button>
                    </div>

                </div>
            </div>

            @if($posts->count() > 3)
            <div class="row">
                @foreach($posts->skip(3) as $post)
                <div class="col-md-4 mt-3 mb-3">
                    <div class="card">
                        <div class="position-absolute px-3 py-2" style="background-color: rgba(0,0,0,0.7);">
                            <a href="#" class="text-decoration-none text-white">
                                {{ $post->category->name }}
                            </a>
                        </div>

                        @if($post->image)
                        <img src="{{ asset('storage/'.$post->image) }}" class="card-img-top" alt="...">
                        @else
                        <img src="https://source.unsplash.com/1200x600/?nature" class="card-img-top" alt="...">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $post->title }}</h5>
                            <p>
                                <small class="text-muted">
                                    <i class="fas fa-calendar"></i> {{ $post->published_at }} | <i class="fas fa-user"></i> <a href="#" class="text-decoration-none">{{ $post->user->name }}</a> | <i class="fas fa-eye"></i> 0 
                                </small>
                            </p>
                            <p class="card-text text-justify">
                                {{ $post->excerpt }}
                            </p>
                            <a href="/home/detail/{{ $post->slug }}" class="btn btn-primary">Read more</a>
                        </div>


                    </div>
                </div>
                @endforeach
            </div>
            @endif

        </div>
        
        @include('frontend/template/sidebar')

    </div>
    
    @else
    <p class="h3">Postingan tidak ditemukan</p>
    @endif

</aside>
@endsection