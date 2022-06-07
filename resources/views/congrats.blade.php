
@extends("template.default")

@section('title')
Congrats !
@endsection

@section("custom-css")
<link rel="stylesheet" href="../lang/css/congrats.css?cache=<?php echo time(); ?>">
@endsection

@section("content")
<div class="page">
    <i class="fa fa-check-circle icon text-success"></i>
    <h1 class="text-success">Awesome !</h1>
    <p>we have sent your url and password to your email !</p>
</div>
@endsection
