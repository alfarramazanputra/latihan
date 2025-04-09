<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>App</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <!-- Custom CSS tanpa Vite -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #081420;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar .brand {
            font-family: 'Poppins', sans-serif;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 30px;
            color: #ffffff;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #ced4da;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        .sidebar a i {
            margin-right: 10px;
            font-size: 18px;
        }
        .sidebar a.active {
            background-color: #007bff;
            color: white;
        }
        .sidebar a:hover {
            background-color: #1c2f48;
            color: white;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            width: 100%;
        }
        .logout-container {
            padding-top: 20px;
        }
        .btn-logout {
            width: 100%;
            text-align: left;
            color: #ced4da;
            font-size: 16px;
            padding: 12px 15px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            background-color: transparent;
            border: none;
        }
        .btn-logout:hover {
            background-color: #1c2f48;
            color: white;
        }
        .dropdown-menu {
            background-color: white;
        }

        /* Fix input styling */
        input,
        textarea,
        select {
            background-color: #ffffff !important;
            color: #212529 !important;
            border: 1px solid #ced4da !important;
            box-shadow: none !important;
        }

        input::placeholder,
        textarea::placeholder {
            color: #6c757d !important;
        }

        input:focus,
        textarea:focus,
        select:focus {
            background-color: #ffffff !important;
            color: #212529 !important;
            border-color: #86b7fe !important;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25) !important;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column justify-content-between vh-100 p-3">
        <div>
            <div class="brand">YourApp</div>
            <a href="/" class="nav-link" data-page="dashboard"><i class="bi bi-grid"></i> Dashboard</a>
            <a href="{{ route('products.index') }}" class="nav-link" data-page="produk"><i class="bi bi-shop"></i> Produk</a>
            <a href="{{ route('sales.index') }}" class="nav-link" data-page="penjualan"><i class="bi bi-cart"></i> Penjualan</a>
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('users.index') }}" class="nav-link" data-page="user"><i class="bi bi-person"></i> User</a>
            @endif
        </div>

        <!-- Logout -->
        <div class="logout-container">
            <div class="dropdown">
                <button class="btn btn-light btn-logout dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    🔓 Logout
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> Keluar
                        </a>
                    </li>
                </ul>
            </div>
            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const navLinks = document.querySelectorAll(".nav-link");

            let activePage = window.location.pathname === "/" ? "dashboard" : localStorage.getItem("activePage") || "dashboard";

            function setActive(page) {
                navLinks.forEach(link => {
                    if (link.getAttribute("data-page") === page) {
                        link.classList.add("active");
                    } else {
                        link.classList.remove("active");
                    }
                });
                localStorage.setItem("activePage", page);
            }

            setActive(activePage);

            navLinks.forEach(link => {
                link.addEventListener("click", function () {
                    setActive(this.getAttribute("data-page"));
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
