@extends('layouts.dashboard.testmaster')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.categories')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.categories')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.categories') <small>{{ $categories->count() }}</small></h3>

                    <form action="{{ route('dashboard.categories.index') }}" method="get">

                        <div class="row">


                            <div class="col-md-4">
                                <input type="search" name="search" class="form-control form-control-lg" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <select name="status" class="form-control" style="text-align: center">
                                    <option value="">---@lang('site.All')-----</option>

                                       <option value='active'>Active</option>
                                       <option value='archvied'>Archvied</option>

                                </select>
                            </div>

                            <div class="col-md-4">

                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>

                                <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                <a href="{{ route('dashboard.Archive.index') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Trash</a>

                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">



                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.description')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.status')</th>
                                <th>@lang('site.sub_category')</th>
                                <th>@lang('site.related_products')</th>
                                <th colspan="2">@lang('site.action')</th>
                            </tr>
                            </thead>


                            <tbody>
                                @forelse ( $categories as $index=>$category )
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{!! $category->description !!}</td>
                                    <td><img src="{{ $category->image_path }}" style="width: 100px"  class="img-thumbnail" alt=""></td>
                                    <td>{{ $category->status }}</td>
                                    <td>{{ $category->parent->name}}</td>
                                    <td>
                                        <a href="{{ route('dashboard.products.index',['category_id'=>$category->id])}}" class="btn btn-info btn-sm"> @lang('site.related_products') </a>
                                    </td>

                                    <td>

                                            <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>

                                    </td>

                                    <td>
                                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.Archvied')</button>
                                        </form><!-- end of form -->
                                    </td>
                                </tr>

                                @empty

                        <h2>@lang('site.no_data_found')</h2>

                        @endforelse

                            </tbody>

                        </table><!-- end of table -->

                        <!-- Display pagination links -->
                        {{ $categories->withQueryString()->links() }}


                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
