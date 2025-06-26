<?php
include("conn.php");
require_once __DIR__ . '/config.php';
$admin_name = $_SESSION['admin_name'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Lab Automation Admin Panel</title>

  <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="<?= BASE_URL ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/js/select.dataTables.min.css">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="<?= BASE_URL ?>assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- Navbar -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="<?= BASE_URL ?>dashboard.php">
          <img src="<?= BASE_URL ?>assets/images/logo.svg" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="<?= BASE_URL ?>dashboard.php">
          <img src="<?= BASE_URL ?>assets/images/logo-mini.svg" alt="mini logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav me-lg-2">
          <li class="nav-item d-none d-lg-block">
            <h4 class="mb-0 welcome-text">Welcome, <span class="text-black fw-bold"><?= htmlspecialchars($admin_name) ?></span></h4>
            <span class="fw-light">SRS Electrical appliances </span>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-logout d-none d-lg-block">
            <a class="nav-link" href="<?= BASE_URL ?>auth/logout.php">
              <i class="mdi mdi-logout"></i> Logout
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
