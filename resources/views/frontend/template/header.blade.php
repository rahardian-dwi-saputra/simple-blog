<header>
    <div class="row">
        <div class="col-md-12">
            <h1>SIMPLE BLOG</h1>
            <h5><em class="text-muted">Simple and easy to use</em></h5>
        </div>
        <div class="col-md-12">

            <nav class="navbar navbar-expand-lg navbar-dark bg-info">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('assets/dist/img/blogicon.png') }}" width="30" height="30" alt="">
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item {{ ($active === "Home")? 'active':''}}">
                                <a class="nav-link" href="/">
                                    Home <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item {{ ($active === "Blog")? 'active':''}}">
                                <a class="nav-link" href="/blog">Blog</a>
                            </li>
                            <li class="nav-item {{ ($active === "Categoris")? 'active':''}}">
                                <a class="nav-link" href="/blog/category">Categories</a>
                            </li>
                        </ul>

                        
                    </div>

                </div>
            </nav>
        </div>
    </div>
</header>