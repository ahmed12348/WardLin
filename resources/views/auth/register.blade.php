<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Register</title>

    {{--<!-- Bootstrap 3.3.7 -->--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/skin-blue.min.css') }}">

    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome-rtl.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE-rtl.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap-rtl.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/rtl.css') }}">

        <style>
            body, h1, h2, h3, h4, h5, h6 {
                font-family: 'Cairo', sans-serif !important;
            }
        </style>
    @else
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE.min.css') }}">
    @endif

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>
<body class="register-page">

<div class="register-box">

    <div class="register-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div><!-- end of register logo -->

    <div class="register-box-body">
        <p class="register-box-msg">Register a new membership</p>

        <form action="{{ route('register') }}" method="post">
            {{ csrf_field() }}
            {{ method_field('post') }}

            @include('partials._errors')

{{--            <div class="form-group has-feedback">--}}
{{--                <input type="text" name="name" class="form-control" placeholder="Name">--}}
{{--                <span class="glyphicon glyphicon-user form-control-feedback"></span>--}}
{{--            </div>--}}

            <div class="form-group has-feedback">
                <input type="text" name="first_name" class="form-control" placeholder="First Name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>

        </form><!-- end of form -->

    </div><!-- end of register body -->

</div><!-- end of register-box -->

{{--<!-- jQuery 3 -->--}}
<script src="{{ asset('dashboard_files/js/jquery.min.js') }}"></script>

{{--<!-- Bootstrap 3.3.7 -->--}}
<script src="{{ asset('dashboard_files/js/bootstrap.min.js') }}"></script>

{{--icheck--}}
<script src="{{ asset('dashboard_files/plugins/icheck/icheck.min.js') }}"></script>

{{--<!-- FastClick -->--}}
<script src="{{ asset('dashboard_files/js/fastclick.js') }}"></script>

</body>
</html>
