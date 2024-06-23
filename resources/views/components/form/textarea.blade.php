@props([
     'name', 'value' => '',
])


<textarea
 name="{{ $name }}"
 {{ $attributes->class([

    'form-control ckeditor',
    'is-invalid' => $errors->has($name)

 ])}}
 >{{ old($name , $value) }}</textarea>
 @error('{{ $name }}')
 <div class="alert alert-danger">{{ $message }}</div>
@enderror