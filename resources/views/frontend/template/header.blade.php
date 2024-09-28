<div class="container">
    <h1>SIMPLE BLOG</h1>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <div class="container">
   
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item {{ ($active === "Home")? 'active':''}}">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item {{ ($active === "About")? 'active':''}}">
                    <a class="nav-link" href="/about">About</a>
                </li>
                <li class="nav-item {{ ($active === "Blog")? 'active':''}}">
                    <a class="nav-link" href="/blog">Blog</a>
                </li>
                <li class="nav-item {{ ($active === "Categoris")? 'active':''}}">
                    <a class="nav-link" href="/blog/category">Categories</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    @guest
                    <a class="nav-link" href="/login">
                        <i class="fa fa-sign-in-alt"></i> Login
                    </a>
                    @else
                    <a class="nav-link" href="/dashboard">
                        <i class="fa fa-user"></i> {{ auth()->user()->name }}
                    </a>
                    @endguest

                </li>
            </ul>
        </div>
    </div>
</nav>

