<form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data" >
    {{ csrf_field() }}
    {{ method_field('post') }}


        <div class="form-group">

           <x-form.lable>@lang('site.name')</x-form.lable>

          <x-form.input name='name' :value="$category->name" /> {{-- value={{ $category->name }} --}}
        </div>

    <div class="form-group">
        <label>@lang('site.description')</label>
        <x-form.textarea name="description" :value="$category->description" />
    </div>

    <div class="form-group">

        <lable>@lang('site.image')</lable>

        <x-form.input type="file" name='image'  id="imageInput" accept="image/*" />
    </div>

    @if ($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" alt="" height="60">
        <div class="form-group">
            <img src="{{$category->image_path}} "  alt="imagePreview" id="imagePreview" width="100px" class="img-thumbnail">
        </div>
    @else
        <div class="form-group">
            <img src="{{ asset('uploads/category_images/default.png')}}"  alt="imagePreview" id="imagePreview" width="100px" class="img-thumbnail">
        </div>
    @endif

    <div class="form-group">

        <div class="form-group">

            <label for="">@lang('site.status')</label>

            <div>
                <x-form.radio name="status" :checked="$category->status" :options="['active' => 'Active', 'archvied' => 'Archived']" />
            </div>
        </div>

    </div>


    <div class="form-group">

        <label>@lang('site.sub_categories')</label>

        <select name="parent_id" class="form-control form-select">
            <option style="text-align: center" value="">Primary Category</option>
            @foreach($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
            @endforeach
        </select>

        <div class="form-group">
            <label for="">Category Parent</label>

        </div>
        @error('parent_id')
            <div class="alert alert-danger">{{ $message }}</div>
         @enderror


    </div>


    <div class="form-group">
        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> {{ $button_label ??'add'  }}  </button>
    </div>

</form><!-- end of form -->
