<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Hisab Api V1</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name ?? 'Guest' }}</a>
            </div>
        </div>

        <!-- Sidebar Search -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Agents -->
                <li class="nav-item">
                    <a href="{{ route('agents-list') }}" class="nav-link {{ request()->routeIs('agents-list') ? 'active' : '' }}">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Agents</p>
                    </a>
                </li>

                <!-- Call Logs -->
                <li class="nav-item">
                    <a href="{{ route('call-list') }}" class="nav-link {{ request()->routeIs('call-list') ? 'active' : '' }}">
                        <i class="fas fa-phone nav-icon"></i>
                        <p>Call Logs</p>
                    </a>
                </li>

                <!-- Post Call Analysis -->
                <li class="nav-item">
                    <a href="{{ route('post-call-analysis', ['call_id' => '67a48c4023078fbf4209ca88']) }}" class="nav-link {{ request()->routeIs('post-call-analysis') ? 'active' : '' }}">
                        <i class="fas fa-chart-line nav-icon"></i>
                        <p>Post Call Analysis</p>
                    </a>
                </li>

                <!-- API Keys -->
                <li class="nav-item">
                    <a href="{{ route('api-keys.index') }}" class="nav-link {{ request()->routeIs('api-keys.index') ? 'active' : '' }}">
                        <i class="fas fa-key nav-icon"></i>
                        <p>API Keys</p>
                    </a>
                </li>

                <!-- Logout Button -->
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-left text-white w-100">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            <p>Logout</p>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<!-- Optional: JavaScript for Sidebar Interaction -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Improve Sidebar Interactivity
        const currentUrl = window.location.href;
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add('active');
            }
        });
    });
</script>
