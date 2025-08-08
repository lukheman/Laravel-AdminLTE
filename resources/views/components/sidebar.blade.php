<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
                src="./assets/img/AdminLTELogo.png"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">AdminLTE 4</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false"
                id="navigation"
            >

                        <x-nav-link
                            href="{{ route('index')}}"
                            active="{{ request()->routeIs('index')}}"
                        >
                            Dashboard
                        </x-nav-link>
                        <x-nav-link
                            href="{{ route('profile')}}"
                            active="{{ request()->routeIs('profile')}}"
                        >
                            Profile
                        </x-nav-link>
                        <x-nav-link
                            href="{{ route('user-table')}}"
                            active="{{ request()->routeIs('user-table')}}"
                        >
                        Pengguna
                        </x-nav-link>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
