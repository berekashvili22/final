@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-4 p-3">
                    <div class="card" style="width: 18rem;">
                        <img src="/storage/images/{{ $product->image }}" alt="image" class="card-img-top p3" style="width: 18rem; height: 14rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text text-muted">{{ $product->created_at }}</p>
                            <a href="{{ route('show', $product->id) }}" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
