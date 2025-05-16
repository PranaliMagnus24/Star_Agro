<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  @php
  $getSetting = Modules\GeneralSetting\App\Models\GeneralSetting::first();
    @endphp
  <title>@yield('title', 'Dashboard')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ $getSetting->favicon_logo ? url('upload/general_setting/' . $getSetting->favicon_logo) : asset('admin/assets/images/logo/logo.jpg') }}" rel="icon">
  <link href="{{ $getSetting->favicon_logo ? url('upload/general_setting/' . $getSetting->favicon_logo) : asset('admin/assets/images/logo/logo.jpg') }}" rel="apple-touch-icon">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  {{-- <link href="{{ asset('admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet"> --}}
  <!-- Template Main CSS File -->
  <link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/datatables/dataTables.bootstrap5.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/datatables/rowReorder.dataTables.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/datatables/responsive.bootstrap5.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/assets/vendor/datatables/buttons.bootstrap5.min.css') }}" rel="stylesheet">
  <script src="{{ asset('admin/assets/vendor/sweet-alert/sweetalert2@11.js')}}"></script>
  <link href="{{ asset('admin/assets/vendor/select2/select2.min.css') }}" rel="stylesheet">

<style>
/* text editor-->cms */
/* Ensure both types of Quill lists are styled properly */
ol[data-list="bullet"] {
        list-style-type: disc;
        padding-left: 1.5rem;
    }

    ol[data-list="ordered"] {
        list-style-type: decimal;
        padding-left: 1.5rem;
    }

    /* Optional: Better spacing and alignment */
    li {
        margin-bottom: 0.5rem;
    }
</style>
</head>

<body>
<!-------Falsh success message--------->
<div class="container my-3">
    @if(session('success'))
    <script>
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-right',
        iconColor: 'white',
        customClass: {
          popup: 'colored-toast',
        },
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
      });

      (async () => {
        await Toast.fire({
          icon: 'success',
          title: '{{ session('success') }}',
        });
      })();
    </script>
    @endif
  </div>


  <!-- ======= Header ======= -->
@include('admin.layouts.header')

  <!-- ======= Sidebar ======= -->
  @include('admin.layouts.sidebar')

  <main id="main" class="main">
    <div class="pagetitle">
        <h1>@yield('pagetitle')</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">{{ __('messages.Home') }}</a></li>
            <li class="breadcrumb-item">{{ __('messages.Pages') }}</li>
            <li class="breadcrumb-item active">@yield('pagetitle')</li>
          </ol>
        </nav>
       
    </div><!-- End Page Title -->
    @yield('admin')

   
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('admin.layouts.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <!-- Vendor JS Files -->
  <script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js')}}"></script>
  <script src="{{ asset('admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/datatables/dataTables.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/datatables/dataTables.rowReorder.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/datatables/rowReorder.dataTables.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/datatables/dataTables.bootstrap5.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/datatables/dataTables.responsive.js') }}"></script>
  <script src="{{ asset('admin/assets/vendor/datatables/responsive.bootstrap5.js') }}"></script>
<!-- Buttons -->
<script src="{{ asset('admin/assets/vendor/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/datatables/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/datatables/buttons.print.min.js') }}"></script>
<!-- Export Dependencies -->
<script src="{{ asset('admin/assets/vendor/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/select2/select2.min.js') }}"></script>
  <!-- Template Main JS File -->
  <script src="{{ asset('admin/assets/js/main.js') }}"></script>
  <script src="{{ asset('admin/assets/js/datatable.js') }}"></script>

  <script
  src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap"
  async
  defer>
</script>

</script>

<script>
    function initMap() {
        if (window.initMapCallbacks) {
            window.initMapCallbacks.forEach(cb => cb());
        }
    }
</script>
</body>

</html>
