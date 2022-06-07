<?php 
session_start();
?>

@if(! isset($_SESSION['adminauthentication']))
<script>
  window.location = "/404";
  </script>
@else
@extends("template.adminPanel.adminpanelTemplate")
@section("title")
WES-Add Employee
@endsection

@section("custom-css")
<!--tailwind css-->
<link href="/css/app.css" rel="stylesheet">

<link rel="stylesheet" href="{{url('/')}}/lang/css/adminPanel/addEmployee.css?cache=<?php  echo time(); ?>">
@endsection

@section("custom-js")
<script src="lang/js/adminPanel/addEmployee.js?cache=<?php echo time();  ?>"></script>
@endsection

@section("content")
<h1>Add employees</h1>
@endsection


@endif
