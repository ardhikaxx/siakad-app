<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIAKAD — @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-admin:     #1a237e;
            --sidebar-dosen:     #4a148c;
            --sidebar-mahasiswa: #bf360c;
        }
        body { background: #f5f6fa; min-height: 100vh; overflow-x: hidden; }
        .wrapper { display: flex; min-height: 100vh; width: 100%; }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            flex-shrink: 0;
            background: var(--sidebar-{{ auth()->user()->role->name }});
            color: #fff;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            z-index: 1050;
        }
        .sidebar .brand { padding: 20px 16px; font-size: 1.2rem; font-weight: 700; border-bottom: 1px solid rgba(255,255,255,0.15); }
        .sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 10px 16px; border-radius: 6px; margin: 2px 8px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.15); color: #fff; }
        .sidebar .nav-link i { width: 20px; }

        /* Main Content */
        .main-content { flex: 1; display: flex; flex-direction: column; min-width: 0; }
        .topbar { background: #fff; padding: 12px 24px; border-bottom: 1px solid #e0e0e0; display: flex; align-items: center; justify-content: space-between; }
        .page-content { padding: 24px; flex: 1; overflow-y: auto; }

        /* Sidebar Overlay for Mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1040;
        }
        .sidebar-overlay.show { display: block; }

        /* Mobile Specific (Default) */
        @media (max-width: 991.98px) {
            .sidebar {
                position: fixed;
                left: -250px;
            }
            .sidebar.show {
                left: 0;
            }
        }

        /* Desktop Specific */
        @media (min-width: 992px) {
            .sidebar {
                position: sticky;
                top: 0;
                height: 100vh;
            }
            .sidebar.collapsed {
                margin-left: -250px;
            }
        }

        .card { border: none; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .stat-card { border-left: 4px solid; }

        /* Pagination */
        .pagination { gap: 4px; }
        .page-link {
            border-radius: 6px !important;
            border: 1px solid #dee2e6;
            color: #495057;
            min-width: 36px;
            text-align: center;
            font-size: .85rem;
            padding: 5px 10px;
        }
        .page-item.active .page-link {
            background: #1a237e;
            border-color: #1a237e;
            color: #fff;
        }
        .page-link:hover { background: #f0f0f0; color: #1a237e; border-color: #dee2e6; }
        .page-item.disabled .page-link { background: #f8f9fa; color: #adb5bd; }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="wrapper">
        {{-- Sidebar --}}
        <div class="sidebar" id="sidebar">
            <div class="brand">
                <i class="fa fa-graduation-cap me-2"></i> SIAKAD
            </div>
            <nav class="nav flex-column mt-2 grow">
                @php $role = auth()->user()->role->name; @endphp

                @if($role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fa fa-users"></i> Manajemen User
                    </a>
                    <a href="{{ route('admin.courses.index') }}" class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
                        <i class="fa fa-book"></i> Mata Kuliah
                    </a>
                    <a href="{{ route('admin.rooms.index') }}" class="nav-link {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}">
                        <i class="fa fa-door-open"></i> Ruangan
                    </a>
                    <a href="{{ route('admin.schedules.index') }}" class="nav-link {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}">
                        <i class="fa fa-calendar-alt"></i> Jadwal
                    </a>

                @elseif($role === 'dosen')
                    <a href="{{ route('dosen.dashboard') }}" class="nav-link {{ request()->routeIs('dosen.dashboard') ? 'active' : '' }}">
                        <i class="fa fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('dosen.schedules') }}" class="nav-link {{ request()->routeIs('dosen.schedules*') ? 'active' : '' }}">
                        <i class="fa fa-calendar-alt"></i> Jadwal Mengajar
                    </a>

                @elseif($role === 'mahasiswa')
                    <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                        <i class="fa fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('mahasiswa.schedules') }}" class="nav-link {{ request()->routeIs('mahasiswa.schedules') ? 'active' : '' }}">
                        <i class="fa fa-calendar-alt"></i> Jadwal Kuliah
                    </a>
                    <a href="{{ route('mahasiswa.enrollments.index') }}" class="nav-link {{ request()->routeIs('mahasiswa.enrollments.*') ? 'active' : '' }}">
                        <i class="fa fa-clipboard-list"></i> KRS Saya
                    </a>
                @endif
            </nav>
            <div class="p-3 border-top" style="border-color: rgba(255,255,255,0.15) !important;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light w-100">
                        <i class="fa fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="main-content">
            <div class="topbar">
                <div class="d-flex align-items-center">
                    <button class="btn btn-link text-dark p-0 me-3" id="sidebarToggle">
                        <i class="fa fa-bars fs-5"></i>
                    </button>
                    <h6 class="mb-0 fw-semibold">@yield('title', 'Dashboard')</h6>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-secondary text-capitalize">{{ auth()->user()->role->name }}</span>
                    <span class="text-muted d-none d-sm-inline small">{{ auth()->user()->name }}</span>
                </div>
            </div>
            <div class="page-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar Toggle Logic
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        sidebarToggle.addEventListener('click', function() {
            if (window.innerWidth < 992) {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
            }
        });

        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        });

        // Konfirmasi hapus
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Yakin ingin menghapus data ini?')) e.preventDefault();
            });
        });

        // Toggle Password Visibility
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
