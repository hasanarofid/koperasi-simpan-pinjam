<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KSP Modern') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts and Styles -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); }
        .sidebar-active { background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); color: white; box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3); }
    </style>
</head>
<body class="h-full overflow-hidden text-slate-900">
    <div class="flex h-full">
        <!-- Sidebar -->
        <div class="hidden lg:flex lg:flex-col lg:w-64 lg:fixed lg:inset-y-0 lg:border-r lg:border-slate-200 lg:bg-white lg:pt-5 lg:pb-4 overflow-y-auto shadow-sm">
            <div class="flex items-center flex-shrink-0 px-6 space-x-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <span class="text-xl font-bold text-slate-800 tracking-tight tracking-tight">KSP Modern</span>
            </div>
            
            <nav class="mt-8 flex-1 px-4 space-y-1">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'sidebar-active' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }} group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                
                <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Operational</div>
                
                <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-slate-600 rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-all duration-200">
                    <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Members
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-slate-600 rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-all duration-200">
                    <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Savings
                </a>

                <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-slate-600 rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-all duration-200">
                    <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Loans
                </a>

                <div class="pt-4 pb-2 px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Reports</div>

                <a href="#" class="flex items-center px-4 py-3 text-sm font-medium text-slate-600 rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-all duration-200">
                    <svg class="mr-3 h-5 w-5 text-slate-400 group-hover:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Accounting
                </a>
            </nav>

            <div class="flex-shrink-0 flex border-t border-slate-200 p-4 bg-slate-50">
                <a href="#" class="flex-shrink-0 w-full group block">
                    <div class="flex items-center">
                        <div class="inline-block h-9 w-9 rounded-full bg-slate-200 overflow-hidden">
                             <svg class="h-full w-full text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-slate-700 group-hover:text-slate-900">{{ auth()->user()->name }}</p>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-xs font-medium text-slate-500 group-hover:text-slate-700 underline decoration-slate-300 transition-all cursor-pointer">Logout</button>
                            </form>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Main content area -->
        <div class="lg:pl-64 flex flex-col flex-1 h-full">
            <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none bg-slate-50/50">
                <div class="py-10 px-4 sm:px-6 lg:px-12 max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
