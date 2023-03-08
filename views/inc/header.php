<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!--favicon-->
   <link rel="icon" type="image/x-icon" href="<?php echo URLROOT ?>/favicon.ico">

   <!-- font-awesome css -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


   <!-- Animated Css -->
   <link rel="stylesheet" href="<?php echo URLROOT . '/css/animated.min.css' ?>">

   <!--Custome css-->
   <link rel="stylesheet" href="<?php echo URLROOT . '/css/main.css' ?>">

   <?php if (function_exists('yield_head')) {
      yield_head($data);
   } ?>

   <title><?php echo $data['title'] ?></title>
</head>

<body style="overflow: hidden">

   <!-- Preloader Page -->
   <div id="page-preloader">
      <div class="loader"></div>

   </div>


   <main class="main-layout">
      <header class="header-section">
         <?php if (empty($data['super_admin'])) : ?>
            <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark py-2">
               <div class="container">
                  <a class="navbar-brand font-weight-bold text-uppercase" href="<?= !is_admin() ? '/' : '/user/dashboard' ?>"><?= is_admin() ? SITENAME . ' ADMIN' : SITENAME ?></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavDropdown">

                     <?php if (!is_admin()) : ?>

                        <ul class="navbar-nav">

                           <li class="nav-item <?php echo matchRoute('/') ? 'active' : '' ?>">
                              <a class="nav-link" href="/">Home</a>
                           </li>

                           <li class="nav-item <?php echo matchRoute('/pages/services') ? 'active' : '' ?>">
                              <a class="nav-link" href="/pages/services">Services </a>
                           </li>

                           <li class="nav-item <?php echo matchRoute('/pages/contact') ? 'active' : '' ?>">
                              <a class="nav-link" href="/pages/contact">Contact</a>
                           </li>


                        </ul>

                     <?php endif ?>

                     <ul class="navbar-nav ml-auto">
                        <?php if (is_auth_user()) : ?>

                           <li class="nav-item  dropdown">

                              <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                 <?= $_SESSION['name'] ?>
                              </a>
                              <div class="dropdown-menu ">
                                 <?php if (!empty($_SESSION['admin_secrete']) || !is_admin()) { ?>
                                    <div class="text-center">
                                       <span class="nav-avatar-container ">
                                          <span class="avater-container-img" style="background-image: url('<?= URLROOT . '/static/avatar/' . $_SESSION['avatar_path'] ?>');">
                                             <img src="<?= URLROOT . '/static/avatar/' . $_SESSION['avatar_path'] ?>" hidden>
                                          </span>
                                       </span>
                                    </div>

                                    <a class="dropdown-item " href="/user/dashboard">Dashboard</a>
                                    <a class="dropdown-item " href="/user/profile">Profile</a>
                                    <a class="dropdown-item " href="/user/edit_profile">Settings</a>
                                 <?php } ?>
                                 <a class="dropdown-item " href="/user/signout">Signout</a>
                              </div>
                           </li>

                        <?php else : ?>
                           <li class="nav-item ">
                              <a class="nav-link <?php echo matchRoute('/signin') ? 'active' : '' ?>" href="/signin">SIGN IN</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link <?php echo matchRoute('/signup') ? 'active' : '' ?>" href="/signup">SIGN UP</a>
                           </li>
                        <?php endif ?>
                     </ul>


                  </div>
               </div>

            </nav>

            <div class="fixed-navbar-space"></div>
         <?php endif ?>

         <!-- flash message -->

         <?php view_include('childs/flash', $data) ?>


      </header>