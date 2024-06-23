<form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data" >
    {{ csrf_field() }}
    {{ method_field('post') }}


        <div class="form-group">

           <x-form.lable>@lang('site.name')</x-form.lable>

          <x-form.input name='name' :value="$product->name" /> {{-- value={{ $products->name }} --}}
        </div>

    <div class="form-group">
        <label>@lang('site.description')</label>
        <x-form.textarea name="description" :value="$product->description" />
    </div>



    <div class="form-group">

        <x-form.lable>@lang('site.salary')</x-form.lable>

       <x-form.input name='price' :value="$product->price" /> {{-- value={{ $products->name }} --}}
     </div>


    <div class="form-group">

        <x-form.lable>@lang('site.compare_price')</x-form.lable>

       <x-form.input name='compare_price' :value="$product->compare_price" /> {{-- value={{ $products->name }} --}}
     </div>


     <div class="form-group">

        <label>@lang('site.Store')</label>

        <select name="store_id"  class="form-control" >

            <option style="text-align: center" value=''>-------@lang('site.parents')-------</option>


            @foreach ($stores as $store)

              <option value="{{ $store->id}}" >{{ $store->name }}</option>

            @endforeach
        </select>

    </div>

    <div class="form-group">

        <label>@lang('site.categories')</label>

        <select name="category_id"  class="form-control" >

            <option style="text-align: center" value=''>-------@lang('site.categories')-------</option>


            @foreach ($categories as $category)

              <option value="{{$category->id }}" >{{ $category->name }}</option>

            @endforeach
        </select>

    </div>



    <div class="form-group">

        <lable>@lang('site.image')</lable>

        <x-form.input type="file" name='image'  id="imageInput" accept="image/*" />
    </div>

    @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" alt="" height="60">
        <div class="form-group">
            <img src="{{$product->image_path}} "  alt="imagePreview" id="imagePreview" width="100px" class="img-thumbnail">
        </div>
    @else
        <div class="form-group">
            <img src="{{ asset('uploads/products_images/default.png')}}"  alt="imagePreview" id="imagePreview" width="100px" class="img-thumbnail">
        </div>
    @endif

    @if (is_array(old('tags')))
    @foreach (old('tags') as $tag)
        <input type="text" name="tags[]" class="form-control" value="{{ $tag }}">
    @endforeach
@else
    <input type="text" name="tags[]" class="form-control" value="{{ old('tags') }}">
@endif


    <div class="form-group">

        <div class="form-group">

            <label for="">@lang('site.status')</label>

            <div>
                <x-form.radio name="status" :checked="$product->status" :options="['active' => 'Active', 'archvied' => 'Archived']" />
            </div>
        </div>

    </div>

{{--
    <div class="form-group">

        <label>@lang('site.sub_categories')</label>

        <select name="parent_id" class="form-control form-select">
            <option style="text-align: center" value="">Primary Category</option>
            @foreach($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id', $products->parent_id) == $parent->id)>{{ $parent->name }}</option>
            @endforeach
        </select>

        <div class="form-group">
            <label for="">Category Parent</label>

        </div>
        @error('parent_id')
            <div class="alert alert-danger">{{ $message }}</div>
         @enderror


    </div> --}}


    <div class="form-group">
        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> {{ $button_label ??'add'  }}  </button>
    </div>

</form><!-- end of form -->
