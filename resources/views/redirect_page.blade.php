@extends('layout')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div onload="OnLoadEvent();">
            <p>
                If your browser does not start loading the page,
                press the button below.
                You will be sent back to this site after you
                authorize the transaction.
            </p>
            <form name="ThreeDForm" method="POST" action="{{session('cardinity')['url']}}">
                @csrf
                <button type=submit>Click Here</button>
                <input type="hidden" name="PaReq" value="{{session('cardinity')['PaReq']}}" />
                <input type="hidden" name="TermUrl" value="{{session('cardinity')['TermUrl']}}" />
                <input type="hidden" name="MD" value="{{session('cardinity')['PaymentId']}}" />
            </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function OnLoadEvent()
        {
            // Make the form post as soon as it has been loaded.
            document.ThreeDForm.submit();
        }
    </script>
@endsection
