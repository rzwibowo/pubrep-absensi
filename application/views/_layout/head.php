<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Absensi</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/jquery-ui/jquery-ui.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.css"> -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/daterangepicker/daterangepicker.css">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url() ?>assets/icon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() ?>assets/icon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/icon/favicon-16x16.png">
  <link rel="manifest" href="<?php echo base_url() ?>assets/icon/site.webmanifest">
  <link rel="mask-icon" href="<?php echo base_url() ?>assets/icon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <style>
    .baris-jadwal td:nth-child(2),
    .baris-jadwal .form-check-label {
      white-space: nowrap;
    }

    .table-col-fixed td:first-child,
    .table-col-fixed td:nth-child(2) {
      position: sticky;
      background-color: #ffffff;
      z-index: 10;
    }

    .table-col-fixed td:first-child,
    .table-col-fixed tr:first-child th:first-child {
      width: 38px;
      left: 0;
    }

    .table-col-fixed td:nth-child(2),
    .table-col-fixed tr:first-child th:nth-child(2) {
      left: 38px;
    }

    .table-col-fixed th:first-child,
    .table-col-fixed tr:first-child th:nth-child(2) {
      z-index: 20 !important;
    }

    .table-col-fixed td:nth-child(2),
    .table-col-fixed tr:first-child th:nth-child(2) {
      box-shadow: 5px 0px 5px -2px rgba(127, 127, 127, 0.7) !important;
    }

    .table-col-fixed.double-header tr:nth-child(2) th {
      background-color: #fff;
      border-bottom: 0;
      box-shadow: inset 0 1px 0 #dee2e6, inset 0 -1px 0 #dee2e6;
      position: sticky;
      top: 2em;
      z-index: 10 !important;
    }

    .laporan thead tr:first-child>th:nth-child(n+3),
    .laporan thead tr:nth-child(2)>th:nth-child(4n),
    .laporan tr.baris-jadwal>td:nth-child(4n+6) {
      border-right: 2px solid #9e9e9e;
    }

    .ui-menu.ui-widget.ui-widget-content.ui-autocomplete.ui-front {
      z-index: 99999 !important;
    }

    .libur {
      background-color: rgba(231, 76, 60, .3) !important;
    }

    .active-ring {
      filter: brightness(1.7);
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .5);
      font-weight: bold;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <p class="mr-3 mb-0"><?php echo $user ?></p>
        <a href="<?php echo base_url() ?>home/logout">Logout</a>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo base_url() ?>" class="brand-link">
        <img src="<?php echo base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Absensi</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-header">Menu Utama</li>
            <?php
            if (
              $this->session->userdata('akses') == 'a000000042'
              || $this->session->userdata('akses') == 'a000000004'
            ) {
            ?>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>unit" class="nav-link">
                  <i class="fas fa-cube nav-icon"></i>
                  <p>Unit/Bagian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>karyawan" class="nav-link">
                  <i class="fas fa-user-friends nav-icon"></i>
                  <p>Karyawan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>shift" class="nav-link">
                  <i class="fas fa-clock nav-icon"></i>
                  <p>Shift</p>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                  Jadwal
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url() ?>jadwal/inputJadwal" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Input Jadwal</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url() ?>jadwal/daftar" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Daftar Jadwal</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url() ?>izin" class="nav-link">
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>Cuti/Izin</p>
              </a>
            </li>
            <?php
            if (
              $this->session->userdata('akses') == 'a000000042'
              || $this->session->userdata('akses') == 'a000000004'
            ) {
            ?>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clipboard-list"></i>
                  <p>
                    Laporan Kehadiran
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>jadwal/laporan" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Per Unit</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>jadwal/laporanKyw" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Per Karyawan</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php } ?>
            <?php
            if (
              $this->session->userdata('akses') == 'a000000042'
            ) {
            ?>
              <li class="nav-item">
                <a href="<?php echo base_url() ?>user" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            <?php } ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"><?php echo $judul ?></h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">