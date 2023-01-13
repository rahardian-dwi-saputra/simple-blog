<div id="navbar" class="navbar navbar-default">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>

    <div class="navbar-container" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="#" class="navbar-brand">
                <small>
                    <i class="fa fa-th"></i>
                    Simple Blog
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Jason's Photo" />
                        <span class="user-info">
                            <small>Welcome,</small>
                            {{ auth()->user()->name }}
                        </span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#">
                                <i class="ace-icon fa fa-cog"></i>
                                Ganti Password
                            </a>
                        </li>
                        <li>
                            <a href="profile.html">
                                <i class="ace-icon fa fa-user"></i>
                                Profil Saya
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <form method="post" action="/logout">
                                @csrf
                                <button type="submit" class="btn btn-link" style="color:#000;">
                                    <i class="fa fa-sign-out fa-fw"></i> Logout
                                </button>
                            </form>
                            
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>