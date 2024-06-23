@extends('layouts.dashboard.testmaster')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.profile')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                {{-- <li><a href="{{ route('dashboard.users.index') }}"></i> @lang('site.users')</a></li> --}}
                <li class="active">@lang('site.profile')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.edit') </h3>

                    @include('partials._errors')

                    <form action="{{ route('dashboard.user.profile.update') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}

                                <div class="form-row">
                                    {{--First_Name  --}}
                                    <div class="col-md-6">
                                        <label>@lang('site.First_Name')</label>
                                        <x-form.input  name="first_name" class="form-control" :value="$user->profile->first_name" />
                                    </div>
                                    {{-- Last_Name --}}
                                    <div class="col-md-6">
                                        <label>@lang('site.Last_Name')</label>
                                        <x-form.input  name="last_name" class="form-control" :value="$user->profile->last_name" />
                                    </div>
                                </div>

                                <div class="form-row">

                                    {{--birthday  --}}
                                    <div class="col-md-6">
                                        <label>@lang('site.birthday')</label>
                                        <x-form.input  type='date' name="birthday" class="form-control" :value="$user->profile->birthday" />
                                    </div>

                                    {{-- gender --}}
                                    <div class="col-md-6">
                                        <label>@lang('site.gender')</label>
                                    {{-- <x-form.radio  name="gender" :checked="$user->profile->gender" :options="['mail' => 'Mail', 'female' => 'Female']" /> --}}
                                    <x-form.radio name="gender" class="form-control" :options="['male'=>'Male', 'female'=>'Female']" :checked="$user->profile->gender" />

                                    </div>
                                </div>

                                <div class="form-row">
                                    {{-- Street Address --}}
                                    <div class="col-md-4">
                                        <label for="">Street Address</label>
                                        <x-form.input name="street_address" label="Street Address" :value="$user->profile->street_address" />
                                    </div>
                                    {{-- city --}}
                                    <div class="col-md-4">
                                        <label for="">City</label>
                                        <x-form.input name="city"  :value="$user->profile->city" />
                                    </div>
                                    {{-- state --}}
                                    <div class="col-md-4">
                                        <label for="">State</label>
                                        <x-form.input name="state"  :value="$user->profile->state" />
                                    </div>
                                </div>


                                <div class="form-row">

                                        {{-- postal Code --}}
                                        <div class="col-md-4">
                                            <label for="">postal Code</label>
                                            <x-form.input  name='postal_code'  :value="$user->profile->postal_code" />
                                        </div>

                                        {{-- country --}}
                                        <div class="col-md-4">
                                            <x-form.select label='country' name='country' :options="$countries" :selected="$user->profile->country" />
                                        </div>

                                        {{-- locale --}}
                                        <div class="col-md-4">
                                            <x-form.select label='Language' name='locales' :options="$locales" :selected="$user->profile->locale" />
                                        </div>

                                </div>



                                <div class="col-md-12 " style="margin-top: 10px !important">
                                    <button class="btn btn-primary  " type="submit"><i class="fa fa-edit"></i>@lang('site.edit')</button>

                                </div>

                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box header -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
