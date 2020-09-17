<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Honeywell Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URL; ?>node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/externallibs/adminlte/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/main.css" />
    <?php
    if (isset($this->css))
    {
        foreach ($this->css as $css)
        {
            echo '<link rel="stylesheet" href="'.URL.$css.'">';
        }
    }
    ?>

    <script type="text/javascript" src="<?php echo URL; ?>node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/externallibs/adminlte/adminlte.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/main.js"></script>

    </script>
    <?php
    if (isset($this->js))
    {
        foreach ($this->js as $js)
        {
            echo '<script type="text/javascript" src="'.URL.$js.'"></script>';
        }
    }
    ?>
</head>
<body class="sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <?php require 'views/navbar.php'; ?>
    <!-- Navbar END -->
    <!-- Aside -->
    <?php require 'views/aside.php'; ?>
    <!-- Aside END -->

    <!-- Content Wrapper -->
    <div class="content-wrapper" style="min-height: 653px;">
      <!-- Content Header -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">
                <?php $sayfaadi = isset($this->sayfaAdi) ? $this->sayfaAdi : "Böyle bir sayfa yok";
                echo $sayfaadi; ?>
              </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">............</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- Content Header END-->

      <section class="content">
        <div class="container-fluid">
            <!-- content goes here -->
