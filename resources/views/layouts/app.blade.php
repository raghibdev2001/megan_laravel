<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title')</title>
  
  @include('layouts.header')
  @yield('style');
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        @include('layouts.navbar')
      </nav>

      <div class="main-sidebar sidebar-style-2">
        @include('layouts.sidebar')
      </div>
      <!-- Main Content -->
      <div class="main-content">
        
        @yield('content')
        @include('layouts.settingsidebar')
      </div>

      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; {{date('Y')}} <div class="bullet"></div> Developed By <a href="https://cybertronlabs.com">CybertronLabs Pvt Ltd</a>
        </div>
        <div class="footer-right">
        </div>
      </footer>

    </div>
  </div>
  
  @include('layouts.footer')
  @yield('style');
</body>
</html>