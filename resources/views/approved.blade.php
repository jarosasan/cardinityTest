@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-4">
            @if (session()->has('message'))
                <h1 class="cover-heading">{{session('message')}}</h1>
            @endif
            <a href="{{route("product.index")}}" class="btn btn-lg btn-secondary">Back to shop</a>
        </div>
    </div>
@endsection
