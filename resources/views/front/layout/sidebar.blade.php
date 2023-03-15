 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('front_show') }}">
         <div class="sidebar-brand-icon rotate-n-15">
         </div>
         <div class="sidebar-brand-text mx-3">Agenda Pimpinan UNP</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     {{-- searchbar --}}
     <div class="form-outline">
        <input type="search" id="form1" class="form-control" placeholder="Type query" aria-label="Search" />
      </div>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Nama
     </div>
     @foreach ($search as $item)
         <li class="nav-item">
             <a class="nav-link" href="{{ route('front_show2', $item->id) }}">
                 <i class="fas fa-fw fa-tachometer-alt">
                 </i><span>{{ $item->nama }}</span>
             </a>
         </li>
     @endforeach
     {{-- <li class="nav-item {{ Request::is('admin/setting') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('admin_setting') }}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Setting</span></a>
     </li> --}}

     <!-- advertisements -->
     {{-- <li
         class="nav-item {{ Request::is('admin/top-ads', 'admin/home-ads', 'admin/sub-category/*', 'admin/sidebar-ads', 'admin/add-sidebar-ads', 'admin/edit-sidebar-ads/*') ? 'active' : '' }}">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
             aria-expanded="true" aria-controls="collapseTwo">
             <i class="fas fa-fw fa-cog"></i>
             <span>Advertisements</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item {{ Request::is('admin/top-ads') ? 'active' : '' }}"
                     href="{{ route('admin_top_ad_show') }}">Top Advertisements</a>
                 <a class="collapse-item {{ Request::is('admin/home-ads') ? 'active' : '' }}"
                     href="{{ route('admin_home_ad_show') }}">Home Advertisements</a>
                 <a class="collapse-item {{ Request::is('admin/sidebar-ads', 'admin/add-sidebar-ads', 'admin/edit-sidebar-ads/*') ? 'active' : '' }}"
                     href="{{ route('admin_sidebar_ad_show') }}">Sidebar Advertisements</a>
             </div>
         </div>
     </li> --}}

     <!-- category, sub category, post -->
     {{-- <li
         class="nav-item {{ Request::is('admin/category/*', 'admin/post/*', 'admin/sub-category/*') ? 'active' : '' }}">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
             aria-expanded="true" aria-controls="collapseThree">
             <i class="fas fa-fw fa-cog"></i>
             <span>News</span>
         </a>
         <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item {{ Request::is('admin/category/*') ? 'active' : '' }}"
                     href="{{ route('admin_category_show') }}">Categories</a>
                 <a class="collapse-item {{ Request::is('admin/sub-category/*') ? 'active' : '' }}"
                     href="{{ route('admin_sub_category_show') }}">Sub Categories</a>
                 <a class="collapse-item {{ Request::is('admin/post/*') ? 'active' : '' }}"
                     href="{{ route('admin_post_show') }}">post</a>
             </div>
         </div>
     </li> --}}

     {{-- menu photo --}}
     {{-- <li class="nav-item {{ Request::is('admin/photo/*') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('admin_photo_show') }}">
             <i class="fas fa-fw fa-camera-retro"></i>
             <span>photo</span></a>
     </li> --}}

     {{-- menu video --}}
     {{-- <li class="nav-item {{ Request::is('admin/video/*') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('admin_video_show') }}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>video</span></a>
     </li> --}}

     <!-- about, faq, disclaimer, contact, login, etc -->
     {{-- <li class="nav-item {{ Request::is('admin/page/*') ? 'active' : '' }}">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
             aria-expanded="true" aria-controls="collapseFour">
             <i class="fas fa-fw fa-cog"></i>
             <span>Pages</span>
         </a>
         <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item {{ Request::is('admin/page/about') ? 'active' : '' }}"
                     href="{{ route('admin_page_about') }}">About</a>
                 <a class="collapse-item {{ Request::is('admin/page/faq') ? 'active' : '' }}"
                     href="{{ route('admin_page_faq') }}">FAQ</a>
                 <a class="collapse-item {{ Request::is('admin/page/contact') ? 'active' : '' }}"
                     href="{{ route('admin_page_contact') }}">Contact</a>
                 <a class="collapse-item {{ Request::is('admin/page/login') ? 'active' : '' }}"
                     href="{{ route('admin_page_login') }}">Login</a>
                 <a class="collapse-item {{ Request::is('admin/page/terms') ? 'active' : '' }}"
                     href="{{ route('admin_page_terms') }}">Terms And Condition</a>
                 <a class="collapse-item {{ Request::is('admin/page/privacy') ? 'active' : '' }}"
                     href="{{ route('admin_page_privacy') }}">Privacy Policy</a>
                 <a class="collapse-item {{ Request::is('admin/page/disclaimer') ? 'active' : '' }}"
                     href="{{ route('admin_page_disclaimer') }}">Disclaimer</a>
             </div>
         </div>
     </li> --}}

     {{-- FAQ --}}
     {{-- <li class="nav-item {{ Request::is('admin/faq_show') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('admin_faq_show') }}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>FAQ</span></a>
     </li> --}}

 </ul>

 <!-- End of Sidebar -->
