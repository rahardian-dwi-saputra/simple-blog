<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="#" class="brand-link">
      <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Simple Blog</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
            <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
         </div>
         <div class="info">
            <a href="#" class="d-block">{{ auth()->user()->name }}</a>
         </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
               <a href="/dashboard" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                     Dashboard 
                  </p>
               </a>
            </li>

            @can('isAdmin')
            <li class="nav-item">
               <a href="/category" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                     Kategori 
                  </p>
               </a>
            </li>
            @endcan

            <li class="nav-item">
               <a href="/post" class="nav-link">
                  <i class="nav-icon fas fa-edit"></i>
                  <p>
                     Postingan Saya 
                  </p>
               </a>
            </li>

            @can('isAdmin')
            <li class="nav-item">
               <a href="/controlpost" class="nav-link">
                  <i class="nav-icon fas fa-list-alt"></i>
                  <p>
                     Kelola Daftar Postingan 
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="/user" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                     User 
                  </p>
               </a>
            </li>
            @endcan

            <li class="nav-item">
               <form method="post" action="/logout">
                    @csrf
                    <button type="submit" class="btn nav-link" style="color:#c2c7d0;">
                        <i class="nav-icon fas fa-sign-out-alt"></i> <p>Logout</p>
                    </button>
                </form>
            </li>
         
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
    <!-- /.sidebar -->
</aside>