<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="centered-layout-wrapper">

        <header class="top-navbar">
            <div class="navbar-container">
            
                <a href="{{ url('/') }}" class="navbar-brand">App Pegawai</a>

                <div class="navbar-user-dropdown">
                    <button class="dropdown-toggle">
                        Dashboard ▾
                    </button>
                    
                    <div class="dropdown-menu">
                        <a href="{{ url('/employees') }}">Employee</a>
                        <a href="{{ url('/departments') }}">Department</a>
                        <a href="{{ url('/positions') }}">Position</a>
                        <a href="{{ url('/attendances') }}">Attendance</a>
                        <a href="{{ url('/salaries') }}">Salary</a>
                    </div>
                </div>

            </div>
        </header>

        <main>
            <div class="content-card">
                <h2>@yield('page-title', 'Dashboard')</h2>
                
                @yield('content')
            </div>
        </main>

        <footer>
            <p>&copy; {{ date('Y') }} App Pegawai. All rights reserved.</p>
        </footer>
        
    </div> </body>
</html>