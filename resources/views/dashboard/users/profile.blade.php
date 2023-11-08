@php
    $currentLanguage = app()->getLocale();
     $name = 'name_' . $currentLanguage;
     $profileImage = Auth::user()->image;

@endphp
@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.profile')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.profile')</li>
            </ol>
        </section>

        <section class="content">


            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset('uploads/user_images/'.$profileImage)}}"
                                         alt="User profile picture">
                                </div>
                                <h4 class="profile-username text-center">{{$user['name_' . $currentLanguage]}} </h4>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            @include('partials._errors')
                                <form method="POST" action="{{ route('dashboard.user_profile_update') }}" enctype="multipart/form-data">
                                    @csrf
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        {{--<li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>--}}
                                        <li class="nav-item active">
                                            <a class="nav-link " href="#personal_info" data-toggle="tab">
                                                 {{ trans('site.about_me') }}
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" href="#change_pass" data-toggle="tab">
                                                تغير كلمة السر
                                            </a>
                                        </li>
                                    </ul>
                                </div><!-- /.card-header -->

                                <div class="card-body">
                                    <div class="tab-content">
                                        <!-- /.tab-pane -->
                                        <div class="active tab-pane" id="personal_info">

                                            @csrf
                                            <div class="form-group row">
                                                <label for="inputName"
                                                       class="col-sm-2 col-form-label">{{ trans('site.first_name') }}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="first_name" class="form-control"
                                                           value="{{$user->first_name}}" id="inputName" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputName2"
                                                       class="col-sm-2 col-form-label">{{ trans('site.last_name') }}</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="last_name" class="form-control"
                                                           value="{{$user->last_name}}" id="inputName" >
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="inputEmail"
                                                       class="col-sm-2 col-form-label">{{ trans('site.email') }}</label>

                                                <div class="col-sm-10">
                                                    <input type="email" name="email" class="form-control"
                                                           id="" value="{{$user->email}}" autocomplete="off"
                                                           placeholder="{{ trans('users.enter_email') }} ..." >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputEmail"
                                                       class="col-sm-2 col-form-label">{{ trans('site.image') }}</label>

                                                <div class="col-sm-10">

                                                    <input type="file" name="image" class="form-control image">

                                                </div>
                                            </div>

                                        </div>

                                        <div class="tab-pane" id="change_pass">
                                            <!-- The timeline -->
                                            <div class="form-group row" style="margin-top: 15px;">
                                                <div class="input-group">

                                                    <input  type="password"
                                                           class="form-control text-capitalize" name="current_password"
                                                           autocomplete="off"
                                                           placeholder="{{ trans('users.enter_old_password') }}...">

{{--                                                    <div class="input-group-append toggle-password">--}}
{{--                                                        <span class="input-group-text fa fa-eye"></span>--}}
{{--                                                    </div>--}}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="input-group">

                                                    <input id="new_password" type="password"
                                                           class="form-control text-capitalize"
                                                           name="new_password" autocomplete="off"
                                                           placeholder="{{ trans('users.enter_new_password') }}...">
                                                    {{--</div>--}}

{{--                                                    <div class="input-group-append toggle-password2">--}}
{{--                                                        <span class="input-group-text fa fa-eye"></span>--}}
{{--                                                    </div>--}}
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="input-group">
                                                    <input id="new_confirm_password" type="password"
                                                           class="form-control text-capitalize"
                                                           name="new_confirm_password"
                                                           autocomplete="off"
                                                           placeholder="{{ trans('users.confirm_new_password') }}...">
{{--                                                    <div class="input-group-append toggle-password">--}}
{{--                                                        <span class="input-group-text fa fa-eye"></span>--}}
{{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                        @lang('site.edit')</button>
                                </div>


                            </form>

                        </div>
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>

@endsection
