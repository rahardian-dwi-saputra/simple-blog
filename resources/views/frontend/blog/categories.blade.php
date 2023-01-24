@extends('frontend/template/main')
@section('title','Categories')
@section('container')

<aside>

    @if($categories->count())
    <div class="row">
        <div class="col-md-8">

            <div class="row">

                @foreach($categories as $category)
                <div class="col-md-4">
                    <a href="#">
                        <div class="card bg-dark text-white mt-3 mb-3">
                            <img src="https://source.unsplash.com/500x500/?{{ $category->name }}" class="card-img" alt="{{ $category->name }}">
                            <div class="card-img-overlay d-flex align-items-center p-0">
                                <h5 class="card-title text-center flex-fill p-2" style="background-color: rgba(0,0,0,0.7);">{{ $category->name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>

        </div>
        
        @include('frontend/template/sidebar')

    </div>
    
    @else
    <p class="h3">Belum ada kategori postingan</p>
    @endif

</aside>
@endsection