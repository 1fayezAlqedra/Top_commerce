 @yield('sidebar')

 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('web.index') }}">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-shopping-cart"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Top Commerce</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item">
         <a class="nav-link" href="{{ route('admin.index') }}">
             <i class="fas fa-tags"></i>
             <span>Dashboard</span></a>
     </li>


     <!-- Divider -->
     <hr class="sidebar-divider">



     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
             aria-expanded="true" aria-controls="collapseCategory">
             <i class="fas fa-fw fa-cog"></i>
             <span>Categories</span>
         </a>
         <div id="collapseCategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="{{ route('admin.categories.index') }}">All Categories</a>
                 <a class="collapse-item" href="{{ route('admin.categories.create') }}">Add New Category</a>
             </div>
         </div>
     </li>


     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct"
             aria-expanded="true" aria-controls="collapseProduct">
             <i class="fas fa-heart"></i>
             <span>Products</span>
         </a>
         <div id="collapseProduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="{{ route('admin.products.index') }}">All Products</a>
                 <a class="collapse-item" href="{{ route('admin.products.create') }}">Add New Product</a>
             </div>
         </div>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="index.html">
             <i class="fas fa-cart-arrow-down"></i>
             <span>Orders</span></a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="index.html">
             <i class="fas fa-money-check"></i>
             <span>Payments</span></a>
     </li>
     <li class="nav-item">
         <a class="nav-link" href="index.html">
             <i class="fas fa-users"></i>
             <span>Users</span></a>
     </li>








     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>
 </ul>
 <!-- End of Sidebar -->
