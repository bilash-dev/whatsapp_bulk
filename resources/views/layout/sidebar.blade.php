<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WhatsApp Module</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/dashboard.js'])

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom js -->
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    
  </head>
  <body>
    <div class="d-flex">
      <!-- Header -->
      <header class="main-header navbar navbar-expand-lg navbar-light bg-white shadow">
        <div class="container-fluid">
          <!-- Toggle Button for Sidebar (mobile) -->
          <button class="btn btn-outline-primary d-lg-none toggle-mobile-sidebar" type="button">
            <i class="fas fa-bars"></i>
          </button>

          {{-- <button class="btn btn-outline-primary position-fixed toggle-sidebar" type="button">
            <i class="fas fa-bars"></i>
          </button> --}}

          <!-- Brand -->
          <a class="navbar-brand ms-5" href="#">Dashboard</a>

          <!-- Search Form -->
          <form class="d-none d-md-flex ms-auto">
            <input type="search" class="form-control me-2" placeholder="Search..." />
            <button class="btn btn-outline-secondary">
              <i class="fas fa-search"></i>
            </button>
          </form>

          <!-- User Avatar -->
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle" height="30" alt="User" />
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                  </form>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </header>
      
      <!-- Overlay for mobile -->
      <div class="overlay"></div>
      
      <!-- Sidebar -->
      <nav class="sidebar bg-info bg-gradient text-white">
        <div class="sidebar-header">
          <h4 class="text-center text-black m-0">Whatsapp Module</h4>
        </div>
        <ul class="nav flex-column px-2">
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link text-white">
              <i class="fas fa-tachometer-alt me-2"></i>
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link text-white">
              <i class="fas fa-paper-plane me-2"></i>
              <span class="nav-link-text">Quick Send</span>
            </a>
          </li>

          <h6 class="text-white mt-3 px-2">Management</h6>
          <li class="nav-item">
            {{-- <a href="{{ route('whatsapp.session') }}" class="nav-link text-white">
              <i class="fab fa-whatsapp me-2"></i>
              <span class="nav-link-text">WhatsApp Accounts</span>
            </a> --}}
            <a href="{{ route('senderId.create') }}" class="nav-link text-white">
              <i class="fab fa-whatsapp me-2"></i>
              <span class="nav-link-text">WhatsApp Accounts</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link text-white">
              <i class="fas fa-credit-card me-2"></i>
              <span class="nav-link-text">My Subscription</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('user.list') }}" class="nav-link text-white">
              <i class="fas fa-users me-2"></i>
              <span class="nav-link-text">My Users</span>
            </a>
          </li>

          <h6 class="text-white mt-3 px-2">Promotion</h6>
          <li class="nav-item">
            <a href="{{ route('upload.csv') }}" class="nav-link text-white">
              <i class="fas fa-address-book me-2"></i>
              <span class="nav-link-text">My Contacts</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('template.create') }}" class="nav-link text-white">
              <i class="fas fa-file-alt me-2"></i>
              <span class="nav-link-text">My Templates</span>
            </a>
          </li>
          <li class="nav-item active">
            <a href="{{ route('campaign.view') }}" class="nav-link text-white">
              <i class="fas fa-bullhorn me-2"></i>
              <span class="nav-link-text">My Campaigns</span>
            </a>
          </li>

          <h6 class="text-white mt-3 px-2">Reports</h6>
          <li class="nav-item">
            <a href="history" class="nav-link text-white">
              <i class="fas fa-history me-2"></i>
              <span class="nav-link-text">Message History</span>
            </a>
          </li>

          <h6 class="text-white mt-3 px-2">Integration</h6>
          <li class="nav-item">
            <a href="#" class="nav-link text-white">
              <i class="fas fa-code me-2"></i>
              <span class="nav-link-text">Developer API</span>
            </a>
          </li>
        </ul>
      </nav>

      <!-- Main Content -->
      <div class="main-content w-100">
       
        <div class="container-fluid p-4">
          <h3>Welcome, {{ Auth::user()->name }}</h3>
          @yield('content')
        </div>
        
      </div>
      
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom js -->
    <link rel="stylesheet" href="{{ asset('js/sidebar.js') }}">
  </body>
</html>