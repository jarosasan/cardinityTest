@extends('layout')
@section('content')
    <div class="row">
        <br>
        <div class="col-md-4 order-md-2 mb-4 text-center">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-2">{{$product->name}}</h6>
                    </div>
                    <span class="text-muted">{{$product->price}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (EUR)</span>
                    <strong>{{$order->amount}}</strong>
                </li>
            </ul>
            <a role="button" class="btn btn-lg btn-block btn-outline-primary" href="{{route
                            ('payment.create', $order->id)}}">Pay</a>
        </div>
    </div>
@endsection
