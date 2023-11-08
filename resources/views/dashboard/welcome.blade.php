@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1 class="text-bold">@lang('site.dashboard')</h1>
            <ol class="breadcrumb">
                <li class="active">@lang('site.dashboard')</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">@lang('site.users')</span>
                            <?php $users = \App\Models\User::all();?>
                            <span class="info-box-number">{{$users->count()}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">@lang('site.orders')</span>
                            <span class="info-box-number">0</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add more info boxes or charts here -->

        </section>
    </div>

@endsection
