<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard | Sleepy Panda')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Dashboard Global Style -->
    <style>
        body {
            background-color: #20223F;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .dashboard-main {
            flex: 1;
            padding: 1.8rem 2rem;
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="dashboard-container">

    {{-- SIDEBAR --}}
    @include('partials.sidebar')

    <div class="dashboard-main">

        {{-- HEADER --}}
        @include('partials.header')

        {{-- PAGE CONTENT --}}
        @yield('content')

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/sidebar.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const profile = document.getElementById('userProfile');
        const dropdown = document.getElementById('profileDropdown');

        profile.addEventListener('click', () => {
            dropdown.style.display =
                dropdown.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', (e) => {
            if (!profile.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });
    });
</script>

@stack('scripts')

</body>
</html>
