<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Siswa</title>
    <!-- Favicon -->
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="../assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/argon-dashboard.css?v=1.1.1" rel="stylesheet"/>
  @yield('style')
</head>
<body>
  @include('sidebar')
    <div class="main-content">
        @yield('content')
      </div>
      <!--   Core   -->
      <script src="../assets/js/plugins/jquery/dist/jquery.min.js"></script>
      <script src="../assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <!--   Optional JS   -->
      <script src="../assets/js/plugins/chart.js/dist/Chart.min.js"></script>
      <script src="../assets/js/plugins/chart.js/dist/Chart.extension.js"></script>
      <!--   Argon JS   -->
      <script src="../assets/js/argon-dashboard.min.js?v=1.1.1"></script>
      <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
      <script>
        window.TrackJS &&
          TrackJS.install({
            token: "ee6fab19c5a04ac1a32a645abde4613a",
            application: "argon-dashboard-free"
          });
      </script>
      <script>
        var $rows = $('#row .data');
          $('.cari').on('keyup',function(){
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
                $rows.show().filter(function(){
              var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
              return !~text.indexOf(val);
            }).hide();
          });
      </script>
      @yield('script')
</body>
</html>