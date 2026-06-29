<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\DiscountCoupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingCharge;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Square\SquareClient;
use Square\Models\Money;
use Square\Exceptions\ApiException;
use Square\Models\CreatePaymentRequest;

use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::with('product_images')->find($request->id);

        if ($product == null) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ]);
        }

        if (Cart::count() > 0) {
            //echo "Product already in cart";
            // Products found in cart
            // Check if this product already in the cart
            // Return as message that product already added in your cart
            // if product not found in the cart, then add product in cart

            $cartContent = Cart::content();
            $productAlreadyExist = false;

            foreach ($cartContent as $item) {
                if ($item->id == $product->id) {
                    $productAlreadyExist = true;
                }
            }


            if ($productAlreadyExist == false) {
              $customPrice = floatval($request->custom_price);
$priceToUse = ($product->is_custom_price && $customPrice > 0)
    ? $customPrice
    : $product->price;

Cart::add($product->id, $product->title, 1, $priceToUse, [
    'productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '',
    'custom_price' => $product->is_custom_price ? $priceToUse : null
                ]);


                $status = true;
                $message = '<strong>' . $product->title . '</strong> added in your cart successfully.';
                session()->flash('success', $message);
            } else {
                $status = false;
                $message = $product->title . ' already added in cart';
            }
        } else {
            $customPrice = floatval($request->custom_price);
$priceToUse = ($product->is_custom_price && $customPrice > 0)
    ? $customPrice
    : $product->price;

Cart::add($product->id, $product->title, 1, $priceToUse, [
    'productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '',
    'custom_price' => $product->is_custom_price ? $priceToUse : null
            ]);

            $status = true;
            $message = '<strong>' . $product->title . '</strong> added in your cart successfully.';
            session()->flash('success', $message);
        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function cart()
    {
        $cartContent = Cart::content();
        //dd($cartContent);
        $data['cartContent'] = $cartContent;
        return view('front.cart', $data);
    }

    public function updateCart(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::get($rowId);

        $product = Product::find($itemInfo->id);
        // check qty available in stock
        if ($product->track_qty == 'Yes') {
            if ($qty <= $product->qty) {
                Cart::update($rowId, $qty);
                $message = 'Cart updated successfully';
                $status = true;
                session()->flash('success', $message);
            } else {
                $message = 'Requested qty(' . $qty . ') not available in stock.';
                $status = false;
                session()->flash('error', $message);
            }
        } else {
            Cart::update($rowId, $qty);
            $message = 'Cart updated successfully';
            $status = true;
            session()->flash('success', $message);
        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function deleteItem(Request $request)
    {

        $itemInfo = Cart::get($request->rowId);

        if ($itemInfo == null) {
            $errorMessage = 'Item not found in cart';
            session()->flash('error', $errorMessage);

            return response()->json([
                'status' => false,
                'message' => $errorMessage
            ]);
        }

        Cart::remove($request->rowId);

        $message = 'Item removed from cart successfully.';

        session()->flash('success', $message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function checkout()
    {
        $discount = 0;

        // If cart is empty, redirect to cart page
        if (Cart::count() == 0) {
            return redirect()->route('front.cart');
        }

        // ✅ Use session-stored guest address instead of Auth::user()
        $customerAddress = session('guest_address');

        $countries = Country::orderBy('name', 'ASC')->get();
        $subTotal = Cart::subtotal(2, '.', '');

        // Apply Discount
        if (session()->has('code')) {
            $code = session()->get('code');
            $discount = ($code->type == 'percent')
                ? ($code->discount_amount / 100) * $subTotal
                : $code->discount_amount;
        }

        // Calculate Shipping
        $totalShippingCharge = 0;
        $grandTotal = $subTotal - $discount;

        if ($customerAddress && isset($customerAddress['country'])) {
            $shippingInfo = ShippingCharge::where('country_id', $customerAddress['country'])->first();
            $totalQty = Cart::content()->sum('qty');

            if ($shippingInfo && $shippingInfo->amount) {
                $totalShippingCharge = $totalQty * $shippingInfo->amount;
            }

            $grandTotal += $totalShippingCharge;
        }

        return view('front.checkout', [
            'countries' => $countries,
            'customerAddress' => $customerAddress,
            'totalShippingCharge' => $totalShippingCharge,
            'discount' => $discount,
            'grandTotal' => $grandTotal,
        ]);
    }



public function processCheckout(Request $request)
{
    // ✅ Debug request (optional for dev)
    // dd($request->all());

    // ✅ 1. Validate form input
    $validator = Validator::make($request->all(), [
        'first_name'    => 'required|string|max:255',
        'last_name'     => 'required|string|max:255',
        'email'         => 'required|email',
        'country'       => 'required',
        'address'       => 'required|min:10',
        'city'          => 'required',
        'state'         => 'required',
        'zip'           => 'required',
        'mobile'        => 'required',
        'payment_method'=> 'required|in:square',
        'square_nonce'  => 'required_if:payment_method,square',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
        // OR for AJAX:
        /*
        return response()->json([
            'message' => 'Please fix the errors',
            'status' => false,
            'errors' => $validator->errors()
        ]);
        */
    }

    // ✅ 2. Store guest address in session
    session(['guest_address' => $request->only([
        'first_name', 'last_name', 'email', 'mobile',
        'country', 'address', 'apartment', 'city', 'state', 'zip'
    ])]);

    // ✅ 3. Prepare Order Data
    $orderData = [
        'first_name'     => $request->first_name,
        'last_name'      => $request->last_name,
        'email'          => $request->email,
        'mobile'         => $request->mobile,
        'country'        => $request->country,
        'address'        => $request->address,
        'apartment'      => $request->apartment,
        'city'           => $request->city,
        'state'          => $request->state,
        'zip'            => $request->zip,
        'order_notes'    => $request->order_notes ?? null,
        'payment_method' => $request->payment_method
    ];

    // ✅ 4. Handle Square Payment
    if ($request->payment_method === 'square') {
        return $this->handleSquarePayment($request, $orderData, $request->square_nonce);
    }

    // ❌ If payment method is unsupported
    return back()->with('error', 'Invalid payment method selected.');
    // OR for AJAX:
    /*
    return response()->json([
        'status' => false,
        'message' => 'Invalid payment method selected.'
    ]);
    */
}

private function handleSquarePayment($request, $orderData, $user = null)
{
    Log::info('Square Nonce:', [$request->square_nonce]);
Log::info('Order Data:', $orderData);
    $subTotal = Cart::subtotal(2, '.', '');
    $discount = session()->has('code') 
        ? ((session('code')['type'] === 'percent') 
            ? (session('code')['amount'] / 100) * $subTotal 
            : session('code')['amount']) 
        : 0;

    $totalQty = Cart::content()->sum('qty');
    $shipping = 0;
    if ($request->country) {
        $shippingInfo = ShippingCharge::where('country_id', $request->country)->first();
        $shipping = $shippingInfo ? $totalQty * $shippingInfo->amount : 0;
    }

    $grandTotal = ($subTotal - $discount) + $shipping;

    // Add financial data to orderData
    $orderData['subtotal'] = $subTotal;
    $orderData['discount'] = $discount;
    $orderData['shipping'] = $shipping;
    $orderData['grand_total'] = $grandTotal;
    $orderData['coupon_code_id'] = session()->has('code') ? session('code')['id'] : null;
    $orderData['coupon_code'] = session()->has('code') ? session('code')['code'] : null;
    $orderData['user_id'] = null; // Guest user
    $orderData['country_id'] = $request->country; // Add country_id

    $client = new SquareClient([
        'accessToken' => 'EAAAl4OotJ-EzraM9VjyKvP8i8lCqFOS1nemH6zynFzRtOHuWP3US3mYiM0-DFAy',
        'environment' => 'production',
    ]);

    $amount = (int) ($grandTotal * 100); // Convert to cents
    if ($amount <= 0) {
    Log::error('Invalid amount passed to Square: ' . $grandTotal);
    return back()->withErrors(['payment' => 'Invalid payment amount.']);
}
    $idempotencyKey = uniqid();

 $money = new Money();
$money->setAmount($amount);
$money->setCurrency('USD');

$body = new CreatePaymentRequest(
    $request->square_nonce,
    $idempotencyKey
);

// 🔥 Set amount_money explicitly
$body->setAmountMoney($money);

// Optional: Set location ID
$body->setLocationId('F9HXR7FP0D497');


    $paymentsApi = $client->getPaymentsApi();

   try {
       
    $result = $paymentsApi->createPayment($body);

    if ($result->isSuccess()) {
        $order = $this->createOrder($orderData, 'paid');
        $this->saveOrderItems($order);
        $this->finalizeOrder($order);

        return redirect()->route('front.thankyou', $order->id);
    }

    // Payment API returned error
    $errors = $result->getErrors();
    Log::error('Square Payment Errors:', ['errors' => $errors]);

    return back()->withErrors([
        'payment' => $errors[0]->getDetail() ?? 'Payment failed'
    ]);

} catch (ApiException $e) {
    Log::error('Square Payment Exception:', ['exception' => $e->getMessage()]);

  if ($result->isError()) {
    $errors = $result->getErrors();
    Log::error('Square Payment Errors:', ['errors' => $errors]);

    $messages = [];

    foreach ($errors as $error) {
        $messages[] = $error->getDetail() ?? 'Unknown payment error';
    }

    return back()->withErrors([
        'payment' => implode("\n", $messages),
    ])->withInput();
}

}

}


    private function prepareOrderData($request, $user)
    {
        $discountCodeId = null;
        $promoCode = '';
        $discount = 0;
        $subTotal = Cart::subtotal(2, '.', '');

        if (session()->has('code')) {
            $code = session()->get('code');
            $discount = ($code->type == 'percent')
                ? ($code->discount_amount / 100) * $subTotal
                : $code->discount_amount;

            $discountCodeId = $code->id;
            $promoCode = $code->code;
        }

        $shippingInfo = ShippingCharge::where('country_id', $request->country)
            ->orWhere('country_id', 'rest_of_world')
            ->first();

        $totalQty = Cart::content()->sum('qty');
        $shipping = $totalQty * $shippingInfo->amount;
        $grandTotal = ($subTotal - $discount) + $shipping;

        return [
            'subtotal' => $subTotal,
            'shipping' => $shipping,
            'grand_total' => $grandTotal,
            'discount' => $discount,
            'coupon_code_id' => $discountCodeId,
            'coupon_code' => $promoCode,
            'user_id' => $user->id,
            'address_data' => $request->only([
                'first_name',
                'last_name',
                'email',
                'mobile',
                'address',
                'apartment',
                'city',
                'state',
                'zip'
            ]),
            'notes' => $request->order_notes,
            'country_id' => $request->country
        ];
    }

   

private function createOrder($orderData, $paymentStatus)
{
    return Order::create([
        'subtotal' => $orderData['subtotal'],
        'shipping' => $orderData['shipping'],
        'grand_total' => $orderData['grand_total'],
        'discount' => $orderData['discount'], // Fixed typo (was 'discount')
        'coupon_code_id' => $orderData['coupon_code_id'],
        'coupon_code' => $orderData['coupon_code'],
        'payment_status' => $paymentStatus,
        'status' => 'pending',
        'user_id' => $orderData['user_id'] ?? null,
        'first_name' => $orderData['first_name'],
        'last_name' => $orderData['last_name'],
        'email' => $orderData['email'],
        'mobile' => $orderData['mobile'],
        'country_id' => $orderData['country_id'],
        'address' => $orderData['address'],
        'apartment' => $orderData['apartment'] ?? null,
        'city' => $orderData['city'],
        'state' => $orderData['state'],
        'zip' => $orderData['zip'],
        'notes' => $orderData['order_notes'] ?? null
    ]);
}

    private function saveOrderItems($order)
    {
        foreach (Cart::content() as $item) {
            OrderItem::create([
                'product_id' => $item->id,
                'order_id' => $order->id,
                'name' => $item->name,
                'qty' => $item->qty,
                'price' => $item->price,
                'total' => $item->price * $item->qty
            ]);

            $this->updateProductStock($item);
        }
    }

    private function updateProductStock($item)
    {
        $product = Product::find($item->id);
        if ($product->track_qty == 'Yes') {
            $product->decrement('qty', $item->qty);
        }
    }

    private function finalizeOrder($order)
    {
        orderEmail($order->id, 'customer');
        Cart::destroy();
        session()->forget('code');
    }

    private function paymentErrorResponse($error)
    {
        return response()->json([
            'message' => 'Payment failed: ' . $error,
            'status' => false
        ], 422);
    }

    public function thankyou($id)
    {

        return view('front.thanks', [
            'id' => $id
        ]);
    }

    public function getOrderSummery(Request $request)
    {
        $subTotal = Cart::subtotal(2, '.', '');
        $discount = 0;
        $discountString = '';

        // Apply Discount Here
        if (session()->has('code')) {
            $code = session()->get('code');

            if ($code->type == 'percent') {
                $discount = ($code->discount_amount / 100) * $subTotal;
            } else {
                $discount = $code->discount_amount;
            }

            $discountString = '<div class=" mt-4" id="discount-response">
                <strong>' . session()->get('code')->code . '</strong>
                <a class="btn btn-sm btn-danger" id="remove-discount"><i class="fa fa-times"></i></a>
            </div>';
        }




        if ($request->country_id > 0) {

            $shippingInfo = ShippingCharge::where('country_id', $request->country_id)->first();

            $totalQty = 0;
            foreach (Cart::content() as $item) {
                $totalQty += $item->qty;
            }

            if ($shippingInfo != null) {

                $shippingCharge = $totalQty * $shippingInfo->amount;
                $grandTotal = ($subTotal - $discount) + $shippingCharge;

                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal, 2),
                    'discount' => number_format($discount, 2),
                    'discountString' => $discountString,
                    'shippingCharge' => number_format($shippingCharge, 2),
                ]);
            } else {
                $shippingInfo = ShippingCharge::where('country_id', 'rest_of_world')->first();

                $shippingCharge = $totalQty * $shippingInfo->amount;
                $grandTotal = ($subTotal - $discount) + $shippingCharge;

                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal, 2),
                    'discount' => number_format($discount, 2),
                    'discountString' => $discountString,
                    'shippingCharge' => number_format($shippingCharge, 2),
                ]);
            }
        } else {

            return response()->json([
                'status' => true,
                'grandTotal' => number_format(($subTotal - $discount), 2),
                'discount' => number_format($discount, 2),
                'discountString' => $discountString,
                'shippingCharge' => number_format(0, 2),
            ]);
        }
    }

    public function applyDiscount(Request $request)
    {
        //dd($request->code);

        $code = DiscountCoupon::where('code', $request->code)->first();

        if (!$code) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid discount coupon',
            ]);
        }

        // Check if coupon start date is valid or not

        $now = Carbon::now();

        //echo $now->format('Y-m-d H:i:s');

        if ($code->starts_at != "") {
            $startDate =  Carbon::createFromFormat('Y-m-d H:i:s', $code->starts_at);

            if ($now->lt($startDate)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid discount coupon',
                ]);
            }
        }

        if ($code->expires_at != "") {
            $endDate =  Carbon::createFromFormat('Y-m-d H:i:s', $code->expires_at);

            if ($now->gt($endDate)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid discount coupon',
                ]);
            }
        }

        // Max Uses Check
        if ($code->max_uses > 0) {
            $couponUsed = Order::where('coupon_code_id', $code->id)->count();

            if ($couponUsed >= $code->max_uses) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid discount coupon',
                ]);
            }
        }

        // Max Uses User Check
        if ($code->max_uses_user > 0) {
            $couponUsedByUser = Order::where(['coupon_code_id' => $code->id, 'user_id' => Auth::user()->id])->count();

            if ($couponUsedByUser >= $code->max_uses_user) {
                return response()->json([
                    'status' => false,
                    'message' => 'You already used this coupon.',
                ]);
            }
        }

        $subTotal = Cart::subtotal(2, '.', '');

        // Min amount condition check
        if ($code->min_amount > 0) {
            if ($subTotal < $code->min_amount) {
                return response()->json([
                    'status' => false,
                    'message' => 'Your min amount must be $' . $code->min_amount . '.',
                ]);
            }
        }

        session()->put('code', [
            'id' => $code->id,
            'code' => $code->code,
            'amount' => $code->discount_amount,
            'type' => $code->type
        ]);

        return $this->getOrderSummery($request);
    }

    public function removeCoupon(Request $request)
    {
        session()->forget('code');
        return $this->getOrderSummery($request);
    }
}
