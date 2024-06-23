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

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.edit') </h3>

                    @include('partials._errors')

                    <form action="{{ route('dashboard.categories.update',$category->id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}



                            <div class="form-group">

                                <label>@lang('site.name')</label> 
                                <input type="text" name="name" class="form-control" value="{{$category->name}}">
                            </div>




                        <div class="form-group">

                            <label>@lang('site.description')</label>

                            <textarea name="description" class="form-control ckeditor">{{ $category->description }}</textarea>
                        </div>

                        <div class="form-group">

                            <lable>@lang('site.image')</lable>

                            <input type="file" name='image' class="form-control"  id="imageInput">

                        </div>

                        <div class="form-group">

                            <img src="{{ $category->image_path }}"  alt="imagePreview" id="imagePreview" width="100px" class="img-thumbnail">

                        </div>

                        <div class="form-group">

                            <label>@lang('site.status')</label>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="active" @checked($category->status == 'active') >
                                <label class="form-check-label" >Active</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="archvied" @checked($category->status == 'archvied')>
                                <label class="form-check-label" >Archvied</label>
                            </div>

                        </div>


                        <div class="form-group">

                            <label>@lang('site.parents')</label>

                            <select name="parent_id" id="" class="form-control" >

                                <option style="text-align: center" value=''>-------@lang('site.parents')-------</option>


                                @foreach ($parents as $subcategory)

                                  <option value="{{ $subcategory->id }}" @selected($category->parent_id == $subcategory->id)>{{ $subcategory->name }}</option>

                                @endforeach
                            </select>

                        </div>


                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i>@lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box header -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
