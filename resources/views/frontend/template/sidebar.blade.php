<div class="col-md-4">

    <div class="card mt-3 mb-3">
        <div class="card-header">
            Postingan Populer
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach($popular_posts as $list_post)
                <li class="list-group-item">
                    <a href="/blog/detail/{{ $list_post->slug }}">
                        {{ $list_post->title }}
                    </a> ( {{ $list_post->view }}x dilihat)
                </li>
                @endforeach
            </ul>
        </div>
    </div>

</div>