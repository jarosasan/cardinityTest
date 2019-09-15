@extends('layout')
    @section('content')
        <div class="row">
            <div class="card-columns col text-center mb-3">
                @foreach($products as $product)
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h2 class="my-0 font-weight-normal">{{$product->name}}</h2>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title mb-5 mt-5">{{$product->price}}<small
                                    class="text-muted">Eur</small></h1>
                            <a role="button" class="btn btn-lg btn-block btn-outline-primary" href="{{route
                    ('order.create', $product->id)}}">Buy</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="">
                {{ $products->links( "pagination::bootstrap-4") }}
            </div>
        </div>
    @endsection
