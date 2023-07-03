<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield("title")</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
  <link rel="stylesheet" href="{{url('/')}}/lang/css/adminPanel/adminpanelTemplate.css?cache=<?php  echo time(); ?>">
  <link rel="stylesheet" href="{{url('/')}}/lang/css/customFramework.css?cache=<?php  echo time(); ?>">
  <!-- start custom css-->
  @yield("custom-css")
  <!--End custom css-->
  <!--custom js-->
  @yield("custom-js")
  <!--end custom js-->
</head>
<body class="bg-light" token="{{ csrf_token() }}" style="">
    <div class="container-fluid p-0 m-0" style="">
        <div class="sidenav  bg-primary" >
            <center>
                <div class="admin-profile">
                <span class="material-icons" style="font-size:40px;">
               account_circle
               </span>
               <h5 class="quicksand-font hi-admin">Hi ! admin</h5>
               <hr color="#ddd">
                </div>
            </center>
            <div class="admin-menu">
                <ul class="navbar-nav">
                    <li class="d-flex align-items-center mb-3">
                    <span class="material-icons mr-2" style="font-size:14px;">group_work</span>
                        <a href="/teamdesign"  class="quicksand-font">Team Design</a>
                    </li>

                    <li class="d-flex align-items-center mb-3">
                    <span class="material-icons mr-2" style="font-size:14px;">badge</span>
                        <a href="/addemployee"  class="quicksand-font">Add Employee</a>
                    </li>

                    <li class="d-flex align-items-center mb-3">
                    <span class="material-icons mr-2" style="font-size:14px;">manage_accounts</span>
                        <a href="/teamdesign"  class="quicksand-font">Team Design</a>
                    </li>
                </ul>
            </div>
        </div>


        <div class="page">
            <!-- start navbar-->
      <!-- <nav class="navbar navbar-expand-lg py-2">
  <a class="navbar-brand mx-4" href="#">ERP Solutions</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Report</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Deparment
        </a>
        <div class="dropdown-menu bg-dark py-0" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="#">Help</a>
      </li>
    </ul>
    
  </div>
</nav> -->
            <!--end navbar-->
        <div class="admin-area" style="">
           @yield("content")
        </div>



        </div>



    </div>

<!--
<span class="material-icons" style="font-size:300px;">
account_circle
</span>
-->

<!-- start full page loader-->
<div class="fullpage-loader d-none">
<div class="lds-ripple"><div></div><div></div></div>
</div>
<!--end full page loader-->

</body>
</html>

