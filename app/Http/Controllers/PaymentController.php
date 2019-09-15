<?php

namespace App\Http\Controllers;

use App\CardPayment;
use App\Http\Requests\CreatePaymentRequest;
use App\Order;
use Cardinity\Method\Payment;
use Cardinity\Exception\Declined;
use Cardinity\Client;
use Cardinity\Method\Payment\Finalize;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = Client::create([
        'consumerKey' => config('services')['cardinity']['client_key'],
        'consumerSecret' => config('services')['cardinity']['client_secret'],
    ]);

    }

    /**
     * Show the form for creating a new resource.
     * @params $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'status'=>Order::CONFIRMED,
        ]);

        return view('confirmation_form', ['order'=>$order]);
    }

    /**
     * Show the approved page.
     * @params Illuminate\Http\Request $request
     * @return  \Illuminate\Contracts\Support\Renderable
     */
    public function approved(Request $request)
    {
        if($request->MD == session('cardinity')['PaymentId']){
            $method = new Finalize($request->MD, $request->PaRes);
            try {
                $payment = $this->client->call($method);
                $status = $payment->getStatus();
                if($status == 'approved'){
                    $this->successPaymentFinalize($payment);
                    return view('approved');
                }
                if($status == 'pending'){
                    $this->pendingPaymentFinalize($payment);
                    return view('redirect_page');
                }
            } catch (Declined $ex) {
                $errors =[];
                foreach ($ex->getErrors() as $key => $error) {
                    $errors[]= $error['message'];
                }
                return redirect()->back()->with('message', $errors);
            }
        }
    }


    /**
     * Make payment.
     * @param \App\Http\Requests\CreatePaymentRequest $request
     * @return void
     */
    public function process(CreatePaymentRequest $request)
    {
        $order = Order::findOrFail($request->order);

        $method = new Payment\Create([
            'amount' => $order->amount,
            'currency' => 'EUR',
            'settle' => false,
            'description' => '3d-pass',
            'order_id' => (string)($request->order*10),
            'country' => 'LT',
            'payment_method' => Payment\Create::CARD,
            'payment_instrument' => [
                'pan' => (string) $request->pan,
                'exp_year' => (integer)$request->exp_year,
                'exp_month' => (integer)$request->exp_month,
                'cvc' => (string)$request->cvc,
                'holder' => $request->name,
            ],
        ]);
        try {
            $payment = $this->client->call($method);
            $status = $payment->getStatus();
            if($status == 'approved'){
                $this->successPaymentFinalize($payment);
                return view('approved');
            }
            if($status == 'pending'){
                $this->pendingPaymentFinalize($payment);
                return view('redirect_page');
            }

        } catch (Declined $ex) {
            $errors =[];
            foreach ($ex->getErrors() as $key => $error) {
                $errors[]= $error['message'];
            }
            return redirect()->back()->with('message', $errors);
        }
    }

       private function pendingPaymentFinalize($payment){
           $info = $payment->getAuthorizationInformation();
           $pendingInfo = [
            'url'=>$info->getUrl(),
            'PaReq'=>$info->getData(),
            'TermUrl'=>url('/payment/approve'),
            'PaymentId'=>$payment->getId()];
           session(['cardinity'=>$pendingInfo]);
           return ;
       }

       private function successPaymentFinalize($payment){
           $paymentId = $payment->getId();
           $order = Order::findOrFail((integer)($payment->getOrderId())/10);
           CardPayment::create([
               'payment_id'=>$paymentId,
               'order_id'=> (integer)($payment->getOrderId())/10
           ]);
           $order->update([
               'status'=> Order::PAYED
           ]);
           session()->flash('message', 'Your payment is approved');
       }

}
