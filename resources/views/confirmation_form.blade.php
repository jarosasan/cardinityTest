@extends('layout')
@section('content')
    <div class="row text-center">

        <div class="col-5 py-5 text-center">
            <h4>Enter Credit card detals</h4>
        </div>
    </div>
    <div class="row text-center">

        <div class="col-5 py-1 text-center">
            @if(session('message'))
            <div class="alert alert-danger" role="alert">
                @foreach(session('message') as $error)
                    {{$error}}
                @endforeach
            </div>
            @endif
        </div>
    </div>
    <div class="text-center">
        <form method="post" action={{route('payment.process')}}>
            @csrf
            <div class="form-group">
                <div class="col-md-4 mb-3">
                    <label>Name Surname</label>
                    <input name="name" type="text" class="form-control"
                    placeholder="Name Surname">
                    @if ($errors->get('name'))
                        @foreach($errors->get('name') as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-4 mb-3">
                    <label >PAN Number</label>
                    <input name="pan" type="number" class="form-control" placeholder="PAN Number">
                    @if ($errors->get('pan'))
                        @foreach($errors->get('pan') as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-md-4 mb-3">
                    <label >Expiration</label>
                    <div class="input-group">
                        <input name="exp_year" type="number" class="form-control"
                               placeholder="2019">
                        @if ($errors->get('exp_year'))
                            @foreach($errors->get('exp_year') as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label >Expiration</label>
                    <div class="input-group">
                        <input name="exp_month" type="number" class="form-control"
                               placeholder="12">
                        @if ($errors->get('exp_month'))
                            @foreach($errors->get('exp_month') as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label>CVC</label>
                    <div class="input-group">
                        <input name="cvc" type="number" class="form-control "
                               placeholder="cvc">
                        @if ($errors->get('cvc'))
                            @foreach($errors->get('cvc') as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <input type="hidden" name="order" value={{$order->id}}>
                <div class="col-md-4 mb-3">
                    <div class="input-group">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Process</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
