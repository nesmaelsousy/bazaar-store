<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- Brand Logo -->
  <!-- <a href="index.html" class="brand-link">
    <img src="{{ asset('backend/image/Brown-removebg-preview.png') }}" width="200" alt="Bazaar Store Logo" class="" style="">

  </a> -->

  <div class="sidebar">

    <!-- User Panel -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('backend/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Admin</a>
      </div>
    </div>



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- Dashboard -->
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <!-- Users -->
        <li class="nav-item has-treeview {{ Route::is('admin.user.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-shield "></i>
            <p>Users <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.user.index') }}" class="nav-link {{ Route::is('admin.user.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.user.create') }}" class="nav-link {{ Route::is('admin.user.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Roles & Permissions</p>
              </a>
            </li>
          </ul>
        </li>
      
        <li class="nav-item has-treeview {{ Route::is('admin.category.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tags"></i>
            <p>Categories <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.category.index') }}" class="nav-link {{ Route::is('admin.category.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Categories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.category.create') }}" class="nav-link {{ Route::is('admin.category.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Category</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- stores -->
        <li class="nav-item has-treeview {{ Route::is('admin.store.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-store"></i>
            <!-- <i class="nav-icon fas fa-shopping-cart"></i> -->
            <p>Stores <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.store.index') }}" class="nav-link {{ Route::is('admin.store.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Stores</p>
              </a>
            </li>
              <li class="nav-item">
              <a href="{{ route('admin.store.create') }}" class="nav-link {{ Route::is('admin.store.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Store</p>
              </a>
            </li>

          </ul>
        </li>
        <!-- Products -->
        <li class="nav-item has-treeview {{ Route::is('admin.product.*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-box"></i>
            <p>Products <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.product.index') }}" class="nav-link {{ Route::is('admin.product.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>All Products</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.product.create') }}" class="nav-link {{ Route::is('admin.product.create') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Product</p>
              </a>
            </li>
          </ul>
        </li>



        <!-- Orders -->
        <li class="nav-item has-treeview">
          <a href="{{ route('admin.order.index') }}" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>Orders <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.order.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All Orders</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Pending</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Completed</p>
              </a>
            </li>
          </ul>
        </li>

      

        <!-- Inventory -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-warehouse"></i>
            <p>Inventory</p>
          </a>
        </li>

        <!-- Reports -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-bar"></i>
            <p>Reports <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sales Report</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Revenue Report</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Coupons -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-ticket-alt"></i>
            <p>Coupons</p>
          </a>
        </li>



        <!-- Statistics -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>Statistics <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Total Users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Total Clients</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Growth Overview</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Settings -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>Settings</p>
          </a>
        </li>
        <li class="nav-link">

          <form action="{{ route('admin.logout') }}" method="POST" class="w-full">
            @csrf
            <button class="btn w-100  bg-danger text-white border-0" type="submit"> <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </button>
          </form>
        </li>
      </ul>
    </nav>
  </div>
</aside>