<nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top shadow">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('front_show') }}">
            <div class="sidebar-brand-text mx-3 text-decoration-none text-light" style="font-weight: bolder">AGENDA PIMPINAN UNP</div>
        </a>

         {{-- searchbar --}}
         <div class="mx-auto">
         <livewire:user-data>
        </div>
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('user_login') }}">
            <div class="sidebar-brand-text mx-3 text-decoration-none text-light" style="font-weight: bolder">Login</div>
        </a>

</nav>
<!-- End of Topbar -->
