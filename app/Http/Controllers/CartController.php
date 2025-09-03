<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'qty' => 'required|integer|min:1'
    ]);

    $product = Product::findOrFail($request->product_id);
    $price = $product->sale_price ?? $product->price;

    // دايمًا بعمل إدخال جديد
    Cart::create([
        'user_id'    => Auth::id(),
        'product_id' => $request->product_id,
        'qty'        => $request->qty,
        'price'      => $price
    ]);

    // تعديل الكمية بالمخزون
    $product->update([
        'quantity' => $product->quantity - $request->qty // تأكد إن اسم العمود صحيح
    ]);

    return redirect()->back()->with('success', 'Product added to cart successfully.');
    }
    public function remove_cart($id)
    {
        $cart = Cart::findOrFail($id);
        $product = $cart->product;
        $product->update([
            'quntity' => $product->quntity + $cart->qty
        ]);
        $cart->delete();
        return redirect()->back();
    }

    function cart()
    {
        $carts = Cart::with('Product')->where('user_id', Auth::id())->whereNull('order_id')->get();
        return view('web.cart', compact('carts'));
    }
    function shop()
    {
        $products = Product::paginate(4);
        return view('web.shop', compact('products'));
    }
    function update_cart(Request $request)
    {
        foreach ($request->new_qty as $id => $qty) {
            Cart::findOrFail($id)->update([
                'qty' => $qty
            ]);
        }
        return redirect()->back();
    }

    function checkout()
    {
        $total = Cart::where('user_id', Auth::id())->whereNull('order_id')->sum(DB::raw('price * qty'));

        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data = http_build_query([
            'entityId' => '8ac7a4c79394bdc801939736f17e063d',
            'amount' => $total,
            'currency' => 'USD',
            'paymentType' => 'DB'
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGFjN2E0Yzc5Mzk0YmRjODAxOTM5NzM2ZjFhNzA2NDF8enlac1lYckc4QXk6bjYzI1NHNng='
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // خليها true في production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $responseData = json_decode($responseData, true);
        $checkoutId = $responseData['id'] ?? null;

        return view('web.checkout', compact('total', 'checkoutId'));
    }


    function checkout_thanks()
    {
        $resourcePath = request()->resourcePath;
        $url = "https://eu-test.oppwa.com/$resourcePath?entityId=8ac7a4c79394bdc801939736f17e063d";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGFjN2E0Yzc5Mzk0YmRjODAxOTM5NzM2ZjFhNzA2NDF8enlac1lYckc4QXk6bjYzI1NHNng='
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // خليها true في production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);

        $responseData = json_decode($responseData, true);
        $responseData['result']['code']; // بتشوف النتيجة النهائية للـ transaction

        // check the response code
        if ($responseData['result']['code'] == '000.100.110') {

            $total = Cart::where('user_id', Auth::id())->whereNull('order_id')->whereNull('order_id')->sum(DB::raw('price * qty'));

            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total
            ]);

            $payment = Payment::create([
                'user_id' => Auth::id(),
                'order_id' => $order->id,
                'total' => $total,
                'transaction_id' => $responseData['id']
            ]);
            $cart = Cart::where('user_id', Auth::id())->whereNull('order_id')->update([
                'order_id' => $order->id
            ]);
            return view('web.checkout_success');
        } else {

            return view('web.checkout_fail');



            
        }
    }



}

