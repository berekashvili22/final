@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('store') }}" class="w-50" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title" style="font-weight: bold">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            @error('title')
                <strong class="error" style="color: red; font-size: 12px" >{{ $message }}</strong>
            @enderror
        </div>
        <div class="form-group">
            <label for="price" style="font-weight: bold">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}">
            @error('price')
                <strong class="error" style="color: red; font-size: 12px" >{{ $message }}</strong>
            @enderror
        </div>
        <div class="form-group">
            <label for="description" style="font-weight: bold">Description</label>
            <textarea type="number" class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            @error('description')
            <strong class="error" style="color: red; font-size: 12px" >{{ $message }}</strong>
            @enderror
        </div>
        <div class="form-group">
            <label for="category_id" style="font-weight: bold">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach ($parent_cats as $parent_cat)
                    <option value="{{ $parent_cat->id }}" disabled style="font-weight: bold">{{ $parent_cat->title }}</option>
                    @foreach ($sub_cats->where('parent_id', '=', $parent_cat->id) as $sub_cat)
                        <option value="{{ $sub_cat->id }}">{{ $sub_cat->title }}</option>
                    @endforeach
                @endforeach
            </select>
            @error('category_id')
                <strong class="error" style="color: red; font-size: 12px" >{{ $message }}</strong>
            @enderror
        </div>
        <div class="form-group">
            <label for="price" style="font-weight: bold">image</label>
            <input type="file" class="form-control-file" id="image" name="image" value="{{ old('image') }}">
            @error('image')
                <strong class="error" style="color: red; font-size: 12px" >{{ $message }}</strong>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
@endsection
