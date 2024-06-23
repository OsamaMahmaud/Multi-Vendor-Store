@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.clients')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.clients.index') }}"></i> @lang('site.clients')</a></li>
                <li class="active">@lang('site.update')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.update') </h3>

                    @include('partials._errors')

                    <form action="{{ route('dashboard.clients.update',$client->id) }}" method="post" >
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}


                            <div class="form-group">

                                <label>@lang('site.name')</label>
                                <input type="text" name="name" class="form-control" value="{{ $client->name }}">
                            </div>

                            @for($i=0;$i<2;$i++)

                                <div class="form-group">

                                    <label>@lang('site.phone')</label>

                                    <input type="text" name="phone[]" class="form-control" value="{{ $client->phone[$i] ?? '' }}" >
                                </div>

                            @endfor

                            <div class="form-group">

                                <label>@lang('site.address')</label>

                                <textarea name="address" class="form-control" value="">{{ $client->address }}</textarea>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i> @lang('site.update')</button>
                            </div>

                    </form><!-- end of form -->

                </div><!-- end of box header -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
