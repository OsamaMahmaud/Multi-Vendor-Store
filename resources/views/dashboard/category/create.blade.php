@extends('layouts.dashboard.testmaster')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.category')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                {{-- <li><a href="{{ route('dashboard.users.index') }}"></i> @lang('site.users')</a></li> --}}
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.add') </h3>

                    @include('partials._errors')

                    @include('dashboard.category._form')

                </div><!-- end of box header -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
