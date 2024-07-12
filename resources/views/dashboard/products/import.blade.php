@extends('layouts.dashboard.testmaster')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.product')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.products.index') }}"></i> @lang('site.products')</a></li>
                <li class="active">@lang('site.import_products')</li>
            </ol>
        </section>

        <section class="content">

           <form action="{{ route('dashboard.products.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="file">Products Count</label>
                    <x-form.input  class="form-control-lg" name="count" />
                </div>
                <button type="submit" class="btn btn-primary">Start Import...</button>
           </form>

           
        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
