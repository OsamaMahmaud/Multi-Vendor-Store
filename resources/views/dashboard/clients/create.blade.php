@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.clients')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.clients.index') }}"></i> @lang('site.clients')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.add') </h3>

                    @include('partials._errors')

                    <form action="{{ route('dashboard.clients.store') }}" method="post" >
                        {{ csrf_field() }}
                        {{ method_field('post') }}


                            <div class="form-group">

                                <label>@lang('site.name')</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            </div>

                            @for($i=0;$i<2;$i++)

                                <div class="form-group">

                                    <label>@lang('site.phone')</label>

                                    <input type="text" name="phone[]" class="form-control" >
                                </div>

                            @endfor

                            <div class="form-group">

                                <label>@lang('site.address')</label>

                                <textarea name="address" class="form-control" value="{{ old('address') }}"></textarea>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> @lang('site.add')</button>
                            </div>

                    </form><!-- end of form -->

                </div><!-- end of box header -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
