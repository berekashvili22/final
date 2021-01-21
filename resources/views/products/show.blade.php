@extends('layouts.app')

@section('content')
<div class="container" style="display: flex;">
    <div class="container">
        <div class="row">
            <div class="col-4 p-3">
                <div class="card" style="width: 40rem;">
                    <img src="/storage/images/{{ $product->image }}" alt="image" class="card-img-top p-3" style="width: 40rem; height: 30rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <h6>{{ $parent_cat }} / {{ $product->category->title }}</h6>
                        <p class="card-text text-muted">{{ $product->price }}</p>
                        <hr>
                        <p class="card-text text-muted">{{ $product->description }}</p>
                        <hr>
                        <p class="card-text text-muted">{{ $product->created_at }}</p>
                        <form action="{{ route('like') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-primary mt-2">{{ $like_count }} Like</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h3>Comments</h3>
        <hr>
        <div class="container" style="height: 75%;">
            @foreach ($comments as $comment)
                <div>
                    <p style="font-weight: bold">{{ $comment->user->name }}</p>
                    <p>{{ $comment->text }}</p>
                </div>
                <hr>
            @endforeach
        </div>
        <form action="{{ route('store_comment') }}" method="post">
            @csrf
            <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
            <input type="text" name="text" id="text" class="form-control" value="{{ old('text') }}" placeholder="Add a comment..." autofocus>
            <button type="submit" class="btn btn-primary mt-2">Comment</button>
            @error('text')
            <span>
                <strong class="error" style="color: red; font-size: 12px" >{{ $message }}</strong>
            </span>
            @enderror
        </form>
    </div>
</div>
@endsection
