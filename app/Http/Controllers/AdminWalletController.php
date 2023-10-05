<?php

namespace App\Http\Controllers;

use App\Common\Enums\PaymentAction;
use App\Common\Enums\PaymentMethod;
use App\Common\Enums\PaymentStatus;
use App\Common\Enums\PrefixCode;
use App\ManualPaymentMethod;
use App\Transaction;
use App\Utility\PayfastUtility;
use Illuminate\Http\Request;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PublicSslCommerzPaymentController;
use App\Http\Controllers\InstamojoController;
use App\Http\Controllers\PaytmController;
use Auth;
use Session;
use App\Wallet;
use App\Utility\PayhereUtility;

class AdminWalletController extends Controller
{
    public function index()
    {
        $wallet       = Wallet::where('user_id', Auth::user()->id)->first();
        $transactions = Transaction::paginate(9);
        return view('backend.admin_wallet.index', compact('wallet', 'transactions'));
    }

    public function recharge(Request $request)
    {
        $data['amount']         = $request->amount;
        $data['payment_method'] = $request->payment_option ?? 'stripe';

        $request->session()->put('payment_type', 'wallet_payment');
        $request->session()->put('payment_data', $data);

        if ($request->payment_option == 'paypal') {
            $paypal = new PaypalController;
            return $paypal->getCheckout();
        } elseif ($request->payment_option == 'stripe') {
            $stripe = new StripePaymentController;
            return $stripe->stripe();
        } elseif ($request->payment_option == 'sslcommerz') {
            $sslcommerz = new PublicSslCommerzPaymentController;
            return $sslcommerz->index($request);
        } elseif ($request->payment_option == 'instamojo') {
            $instamojo = new InstamojoController;
            return $instamojo->pay($request);
        } elseif ($request->payment_option == 'razorpay') {
            $razorpay = new RazorpayController;
            return $razorpay->payWithRazorpay($request);
        } elseif ($request->payment_option == 'paystack') {
            $paystack = new PaystackController;
            return $paystack->redirectToGateway($request);
        } elseif ($request->payment_option == 'proxypay') {
            $proxy = new ProxypayController;
            return $proxy->create_reference($request);
        } elseif ($request->payment_option == 'voguepay') {
            $voguepay = new VoguePayController;
            return $voguepay->customer_showForm();
        } elseif ($request->payment_option == 'payhere') {
            $order_id   = rand(100000, 999999);
            $user_id    = Auth::user()->id;
            $amount     = $request->amount;
            $first_name = Auth::user()->name;
            $last_name  = 'X';
            $phone      = '123456789';
            $email      = Auth::user()->email;
            $address    = 'dummy address';
            $city       = 'Colombo';

            return PayhereUtility::create_wallet_form($user_id,
                $order_id,
                $amount,
                $first_name,
                $last_name,
                $phone,
                $email,
                $address,
                $city);
        } elseif ($request->payment_option == 'payfast') {
            $user_id = Auth::user()->id;
            $amount  = $request->amount;
            return PayfastUtility::create_wallet_form($user_id, $amount);
        } elseif ($request->payment_option == 'ngenius') {
            $ngenius = new NgeniusController();
            return $ngenius->pay();
        } else {
            if ($request->payment_option == 'iyzico') {
                $iyzico = new IyzicoController();
                return $iyzico->pay();
            } else {
                if ($request->payment_option == 'nagad') {
                    $nagad = new NagadController;
                    return $nagad->getSession();
                } else {
                    if ($request->payment_option == 'bkash') {
                        $bkash = new BkashController;
                        return $bkash->pay();
                    } else {
                        if ($request->payment_option == 'mpesa') {
                            $mpesa = new MpesaController();
                            return $mpesa->pay();
                        } else {
                            if ($request->payment_option == 'flutterwave') {
                                $flutterwave = new FlutterwaveController();
                                return $flutterwave->pay();
                            } elseif ($request->payment_option == 'paytm') {
                                $paytm = new PaytmController;
                                return $paytm->index();
                            }
                        }
                    }
                }
            }
        }
    }

    public function wallet_payment_done($payment_data, $payment_details)
    {
        $user            = Auth::user();
        $user->balance   = $user->balance + $payment_data['amount'];
        $user->tenacy_id = get_tenacy_id_for_query();
        $user->save();

        $wallet                  = new Wallet;
        $wallet->user_id         = $user->id;
        $wallet->amount          = $payment_data['amount'];
        $wallet->payment_method  = $payment_data['payment_method'];
        $wallet->payment_details = $payment_details;
        $wallet->save();

        Session::forget('payment_data');
        Session::forget('payment_type');

        flash(translate('Payment completed'))->success();
        return redirect()->route('wallet.index');
    }

    public function offline_recharge(Request $request)
    {
        $wallet              = Wallet::first();
        $manualPaymentMethod = ManualPaymentMethod::where('type', 'bank_payment')->first();
        $detail              = [
            'bank_info' => json_decode($manualPaymentMethod->bank_info, true),
            'image'     => $request->photo
        ];

        $transaction                    = new Transaction();
        $transaction->user_id           = Auth::user()->id;
        $transaction->user_type         = Auth::user()->user_type;
        $transaction->wallet_id         = $wallet->id;
        $transaction->photo             = $request->photo;
        $transaction->attribute         = PaymentAction::RECHARGE;
        $transaction->payment_method    = PaymentMethod::BANK_PAYMENT;
        $transaction->request_amount    = $request->amount;
        $transaction->available_balance = $wallet->amount;
        $transaction->details           = json_encode($detail);
        $transaction->description       = "";
        $transaction->status            = PaymentStatus::PENDING;
        $transaction->reject_reason     = "";
        $transaction->save();

        flash(translate('Offline Recharge has been done. Please wait for response.'))->success();
        return redirect()->route('admin.wallet.index');
    }

    public function offline_recharge_request()
    {
        $wallets = Wallet::where('offline_payment', 1)->paginate(10);
        return view('manual_payment_methods.wallet_request', compact('wallets'));
    }

    public function updateApproved(Request $request)
    {
        $wallet           = Wallet::where('id', $request->id)->first();
        $wallet->approval = $request->status;
        if ($request->status == 1) {
            $user            = $wallet->user;
            $user->balance   = $user->balance + $wallet->amount;
            $user->tenacy_id = get_tenacy_id_for_query();
            $user->save();
        } else {
            $user            = $wallet->user;
            $user->balance   = $user->balance - $wallet->amount;
            $user->tenacy_id = get_tenacy_id_for_query();
            $user->save();
        }
        $wallet->tenacy_id = get_tenacy_id_for_query();
        if ($wallet->save()) {
            return 1;
        }
        return 0;
    }

    public function offline_recharge_modal(Request $request)
    {
        return view('backend.admin_wallet.offline_recharge_modal');
    }
}
