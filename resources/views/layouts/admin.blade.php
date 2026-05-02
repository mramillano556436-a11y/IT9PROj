<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ABIBAS Admin') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --bg: #F5F4F1;
                --surface: #FFFFFF;
                --surface2: #F0EFec;
                --border: #DEDBD6;
                --text: #1A1917;
                --text-2: #6B6860;
                --text-3: #9D9B96;
                --accent: #1A1917;
            }
            
            body {
                background-color: var(--bg);
                color: var(--text);
            }
            
            .sidebar {
                background-color: var(--surface2);
                border-right: 1px solid var(--border);
                min-height: 100vh;
            }
            
            .sidebar-logo {
                font-weight: 600;
                font-size: 1.125rem;
                padding: 1.125rem;
                border-bottom: 1px solid var(--border);
            }
            
            .sidebar-item {
                padding: 0.5625rem 1.125rem;
                color: var(--text-2);
                border-left: 2px solid transparent;
                cursor: pointer;
                transition: all 0.2s;
            }
            
            .sidebar-item:hover {
                background-color: var(--surface);
            }
            
            .sidebar-item.active {
                color: var(--text);
                font-weight: 500;
                border-left-color: var(--text);
                background-color: var(--surface);
            }
            
            .topbar {
                background-color: var(--surface);
                border-bottom: 1px solid var(--border);
                padding: 0.8125rem 1.25rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            
            .topbar-title {
                font-size: 0.9375rem;
                font-weight: 600;
                color: var(--text);
            }
            
            .metric {
                background-color: var(--surface2);
                border-radius: 0.625rem;
                padding: 1rem;
                flex: 1;
            }
            
            .metric-label {
                font-size: 0.6875rem;
                color: var(--text-2);
                margin-bottom: 0.375rem;
            }
            
            .metric-val {
                font-size: 1.375rem;
                font-weight: 600;
                color: var(--text);
            }
            
            .metric-sub {
                font-size: 0.6875rem;
                color: var(--text-3);
                margin-top: 0.1875rem;
            }
            
            .btn-dark {
                background-color: var(--text);
                color: var(--surface);
                border: none;
                padding: 0.5625rem 1.125rem;
                border-radius: 0.375rem;
                font-size: 0.8125rem;
                font-weight: 500;
                cursor: pointer;
            }
            
            .btn-dark:hover {
                opacity: 0.9;
            }
            
            .btn-sm {
                background-color: transparent;
                color: var(--text);
                border: 0.5px solid var(--border);
                padding: 0.3125rem 0.625rem;
                border-radius: 0.375rem;
                font-size: 0.6875rem;
                cursor: pointer;
            }
            
            .badge {
                display: inline-block;
                font-size: 0.6875rem;
                font-weight: 500;
                padding: 0.1875rem 0.5625rem;
                border-radius: 999px;
            }
            
            .badge-green {
                background-color: #E6F4EC;
                color: #1A6335;
            }
            
            .badge-amber {
                background-color: #FDF3E3;
                color: #8A5A00;
            }
            
            .badge-red {
                background-color: #FDECEA;
                color: #A12828;
            }
            
            table {
                border-collapse: collapse;
                width: 100%;
            }
            
            th {
                background-color: var(--surface2);
                border-bottom: 1px solid var(--border);
                padding: 0.5rem 1.25rem;
                font-size: 0.6875rem;
                font-weight: 500;
                color: var(--text-2);
                text-align: left;
            }
            
            td {
                border-bottom: 1px solid var(--border);
                padding: 0.6875rem 1.25rem;
                font-size: 0.8125rem;
                color: var(--text);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex">
            <!-- Sidebar -->
            <div class="w-44 sidebar">
                <div class="sidebar-logo">
                    <div>ABIBAS</div>
                    <div class="text-xs text-gray-500">Admin panel</div>
                </div>
                <nav>
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.products') }}" class="sidebar-item {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                        Products
                    </a>
                    <a href="{{ route('admin.orders') }}" class="sidebar-item {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                        Orders
                    </a>
                    <a href="{{ route('admin.users') }}" class="sidebar-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        Users
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Topbar -->
                <div class="topbar">
                    <div class="topbar-title">{{ $header ?? 'Dashboard' }}</div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-600">Admin</span>
                        <div class="w-7 h-7 rounded-full bg-blue-200 flex items-center justify-center text-xs font-semibold text-blue-700">
                            A
                        </div>
                    </div>
                </div>

                <!-- Page Content -->
                <main class="p-5">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
