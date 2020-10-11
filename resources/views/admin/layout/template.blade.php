<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.includes.header')

    @include('admin.includes.css')

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    @include('admin.includes.topbar')


  <!-- Main Sidebar Container -->

    @include('admin.includes.nav')


  <!-- Content Wrapper. Contains page content -->
    @yield('adminBodyContent')
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  @include('admin.includes.footer')

  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('admin.includes.script')


</body>
</html>
