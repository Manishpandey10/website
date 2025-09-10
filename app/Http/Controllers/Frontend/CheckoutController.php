<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BillingInfo;
use App\Models\Category;
use App\Models\Color;
use App\Models\DeliveryInfo;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use App\Models\Variant;
use App\Models\VariantImage;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Surfsidemedia\Shoppingcart\Cart as ShoppingcartCart;
use Surfsidemedia\Shoppingcart\Facades\Cart as Cart;

class CheckoutController extends Controller
{
    public function checkout()
    {

        $cartdata = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();
        $tax = Cart::tax();
        $count = Cart::count();

        // dd($subtotal);

        // dd($cartdata);

        return view('frontend.checkout', compact('cartdata', 'total', 'subtotal', 'tax', 'count'));
    }


    public function cart()
    {

        $cartdata = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();
        $tax = Cart::tax();
        $count = Cart::count();


        // dd($cartdata);

        if ($cartdata->isEmpty()) {
            session()->flash('emptycart', 'Your cart is empty... continue shopiing');
            return view('frontend.cart', compact('cartdata', 'total', 'subtotal', 'tax', 'count'));
        } else {
            return view('frontend.cart', compact('cartdata', 'total', 'subtotal', 'tax', 'count'));
        }
    }

    public function delete($rowId)
    {
        // dd($rowId);
        Cart::remove($rowId);
        // dd("data deleted from cart");
        session()->flash('removeItem', 'item removed from cart.');
        return redirect()->back();
    }


    public function quickadd($product_id)
    {
        try {
            $product = Products::with(['products_category'])->find($product_id);

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }

            // Get all variants for the product (with color relation)
            $variants = Variant::with('color')
                ->where('product_id', $product_id)
                ->get();

            if ($variants->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No variants found'
                ], 404);
            }

            // Use first variant for initial display
            $firstVariant = $variants->first();
            $calculatedPrice = $firstVariant->price - $firstVariant->discountedPrice;

            // Pick a default image
            $img = $product->firstVariantImage?->name;
            $imgPath = $img && file_exists(public_path('variantThumbnail/' . $img))
                ? url('variantThumbnail/' . $img)
                : asset('images/no-image.jpg');

            // Build product details payload
            $productDetails = [
                'name'        => $product->name,
                'image'       => $imgPath,
                'price'       => $calculatedPrice,
                'discount'    => $firstVariant->discount,
                'actualprice' => $firstVariant->price,
                'variants'    => $variants->groupBy('color_id')->map(function ($variantGroup) {
                    $first = $variantGroup->first();

                    // Calculate price for this color variant
                    $colorPrice = $first->price - $first->discountedPrice;

                    // Get image for this product + color
                    $variantImage = VariantImage::where('product_id', $first->product_id)
                        ->where('color_id', $first->color_id)
                        ->first();

                    return [
                        'color_id'   => $first->color->id,
                        'color_name' => $first->color->name,
                        'color_code' => $first->color->colorCode,
                        'price'      => $colorPrice,           // Add calculated price
                        'discount'   => $first->discount,      // Add discount
                        'actualprice' => $first->price,        // Add actual price
                        'image'      => $variantImage
                            ? url('variantThumbnail/' . $variantImage->name)
                            : asset('images/no-image.jpg'),
                        'sizes'      => $variantGroup->pluck('size')->unique()->values(),
                    ];
                })->values()
            ];

            return response()->json([
                'success'         => true,
                'product_details' => $productDetails
            ]);
        } catch (\Exception $e) {
            Log::error("QuickAdd error: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }



    public function addToCart($product_id, $color_id, $size)
    {

        try {
            $product = Products::with(['products_category'])->find($product_id);
            // dd($product);
            $variantdata = Variant::with('color')
                ->where('product_id', $product_id)->where('size', $size)
                ->whereHas('color', function ($query) use ($color_id) {
                    $query->where('id', $color_id);
                })
                ->first();

            // dd($variantdata);
            $actualPrice = $variantdata->price - $variantdata->discountedPrice;

            // dd($actualPrice);

            $color = Color::find($color_id);
            $color_name = $color->name;
            // dd($color_name);

            $variantImage = VariantImage::where('product_id', $product_id)
                ->when($color_id, fn($query) => $query->where('color_id', $color_id))
                ->first(); ///fetches only one image from the db.

            // dd($variantImage);
            Cart::add(
                $product->id, // id of the product
                $product->name, //name of the product
                1, //quantity
                $actualPrice,
                [
                    "colorName" => $color_name,
                    'image' => $variantImage,
                    "Size" => $size,
                    "Variantdata" => $variantdata
                ]
                // this will be under option menu in cart data
            );
            return response()->json([
                'success' => true,
                'message' => 'Product has been added to cart successfully!',
                'cart_count' => Cart::count() // Optional: return cart count for updating UI
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
        // return redirect()->route('cart.page')->with('success', "Product has been added to cart.");

    }


    // public function createorder(Request $request)
    // {
    //     // if (!Auth::check()) {
    //     //     return redirect()->route('user.login')->with('loginCheck', 'You need to be logged in to place an order.');
    //     // } else {
    //     $request->validate(
    //         [
    //             "fname" => 'required',
    //             "lname" => 'required',
    //             "email" => "required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/",
    //             "country" => 'required',
    //             "address" => 'required',
    //             "state" => 'required',
    //             "postalcode" => 'required',
    //             // "city" => 'required',
    //             // "phone" => 'required|regex:/^\d{10}$/',

    //             'billing_fname' => 'sometimes|required|string|max:255',
    //             'billing_lname' => 'sometimes|required|string|max:255',
    //             'billing_email' => 'sometimes|required|email',
    //             'billing_address' => 'sometimes|required|string',
    //             'billing_country' => 'sometimes|required|string',
    //             'billing_state' => 'sometimes|required|string',
    //             'billing_postalcode' => 'sometimes|required|string',
    //             // 'billing_city' => 'sometimes|required|string',
    //             // 'billing_phone' => 'sometimes|required|digits:10',
    //         ],

    //         [
    //             'fname.required' => 'First Name field is required.',
    //             'lname.required' => 'Last Name field is required.',
    //             'email.required' => 'Email field is required.',
    //             'phone.required' => 'Phone Number field is required.',
    //             'address.required' => 'Adress field is required.',
    //             'country.required' => 'Country field is required.',
    //             'state.required' => 'State field is required.',
    //             'postalcode.required' => 'Pincode field is required.',
    //             // 'city.required' => 'City field is required.',


    //         ]
    //     );
    //     try {
    //         DB::beginTransaction();
    //         $user = Auth::user();
    //         // $userId = $user->id;

    //         $cartdata = Cart::content();
    //         $total = Cart::total();
    //         $subtotal = Cart::subtotal();
    //         $tax = Cart::tax();
    //         $count = Cart::count();
    //         $Itemdata = $cartdata;

    //         dd($cartdata);


    //         $total = 0;
    //         $price = 0;
    //         foreach ($Itemdata as $data) {
    //             $itemTotal = $data->quantity * $data->products->price;
    //             $total += $itemTotal;
    //             $price =  $data->products->price;
    //         }

    //         //creating a order now 

    //         $order = new Order();
    //         $order->invoice_id = 'Random_invoice_id';
    //         $order->txn_id = 'Random_txn_id';
    //         $order->user_id = Auth::user()->id;
    //         $order->name = $request->fname . ' ' . $request->lname;

    //         $order->price = $price;
    //         $order->total = $total;
    //         $order->shipping = 0.00;
    //         $order->delivery_status = "Pending";
    //         $order->save();

    //         $order->order_id = 'E-comm:' . $order->id;
    //         $order->save();


    //         //saving order items
    //         foreach ($Itemdata as $data) {

    //             $items = new OrderItem();
    //             $items->order_id = $order->order_id;
    //             $items->product_id = $data->products->id;
    //             $items->user_id = Auth::user()->id;
    //             $items->sku = "SKU-ABC";
    //             $items->product_name = $data->products->name;
    //             $items->quantity = $data->quantity;
    //             $items->price = $data->price;
    //             $items->image = $data->products->image;
    //             $items->save();
    //         }


    //         $delivery = new DeliveryInfo();
    //         $delivery->order_id = $order->order_id;

    //         $delivery->user_id = $user->id;
    //         $delivery->fname = $request->fname;
    //         $delivery->lname = $request->lname;
    //         $delivery->email = $request->email;
    //         $delivery->address = $request->address;
    //         $delivery->country = $request->country;
    //         $delivery->state = $request->state;
    //         $delivery->city = $request->city;
    //         $delivery->postalcode = $request->postalcode;
    //         $delivery->save();
    //         // billing info 

    //         $billing = new BillingInfo();
    //         $billing->order_id = $order->order_id;
    //         $billing->user_id = $user->id;
    //         $billing->fname = $request->input('billing_fname', $request->input('fname'));
    //         $billing->lname = $request->input('billing_lname', $request->input('lname'));
    //         $billing->email = $request->input('billing_email', $request->input('email'));
    //         $billing->address = $request->input('billing_address', $request->input('address'));
    //         $billing->country = $request->input('billing_country', $request->input('country'));
    //         $billing->state = $request->input('billing_state', $request->input('state'));
    //         $billing->city = $request->input('billing_city', $request->input('city'));
    //         $billing->postalcode = $request->input('billing_postalcode', $request->input('postalcode'));
    //         $billing->save();


    //         //emptying the cart

    //         Cart::destroy();


    //         DB::commit();

    //         return redirect()->route('order.success');
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         Log::error('Failed to save order', [
    //             'message' => $e->getMessage(),
    //             'file' => $e->getFile(),
    //             'line' => $e->getLine(),
    //             'trace' => $e->getTraceAsString(),
    //         ]);

    //         return response()->json([
    //             'error' => $e->getMessage(),
    //             'success' => false,
    //             'message' => $e->getMessage()
    //         ], 500);
    //     }
    //     // }
    //     // return response()->json([
    //     //     "msg_send" => "Order created."
    //     // ]);
    // }


    public function updateCartQty(Request $request)
    {
        $rowId = $request->rowId;
        $type = $request->type;

        $item = Cart::get($rowId);
        if (!$item) {
            return response()->json(['status' => 'error', 'message' => 'Item not found.']);
        }

        $newQty = $type === 'increase' ? $item->qty + 1 : $item->qty - 1;

        if ($newQty < 1) {
            return response()->json(['status' => 'error', 'message' => 'Minimum quantity is 1.']);
        }

        Cart::update($rowId, $newQty);

        return response()->json([
            'status' => 'success',
            'qty' => $newQty,
            'subtotal' => Cart::subtotal(),
            'itemTotal' => $item->price * $newQty,
            'rowId' => $rowId
        ]);
    }



    public function razorpay(Request $request)
    {
        try {
            $request->validate([
                "fname" => 'required',
                "lname" => 'required',
                "email" => "required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/",
                "country" => 'required',
                "address" => 'required',
                "state" => 'required',
                "postalcode" => 'required',

                'billing_fname' => 'sometimes|required|string|max:255',
                'billing_lname' => 'sometimes|required|string|max:255',
                'billing_email' => 'sometimes|required|email',
                'billing_address' => 'sometimes|required|string',
                'billing_country' => 'sometimes|required|string',
                'billing_state' => 'sometimes|required|string',
                'billing_postalcode' => 'sometimes|required|string',
            ], [
                'fname.required' => 'First Name field is required.',
                'lname.required' => 'Last Name field is required.',
                'email.required' => 'Email field is required.',
                'address.required' => 'Address field is required.',
                'country.required' => 'Country field is required.',
                'state.required' => 'State field is required.',
                'postalcode.required' => 'Pincode field is required.',
            ]);

            Log::info('Form validation passed for razorpay payment');

            $cartdata = Cart::content();
            $total = Cart::subtotal();
            // dd($total);
            // Check if the cart is empty before proceeding
            if ($cartdata->isEmpty()) {
                Log::warning('Cart is empty during checkout');
                return response()->json(['msg_send' => 'Your cart is empty.'], 400);
            }

            Log::info('Cart data retrieved', [
                'cart_items' => $cartdata->count(),
                'total' => $total
            ]);

            // dd($cartdata);
          

            $cartArray = [];
            foreach ($cartdata as $item) {
                $cartArray[] = [
                    'id'    => $item->id,
                    'name'  => $item->name,
                    'qty'   => $item->qty,
                    'price' => $item->price,
                    'options' => [
                        'image'     => $item->options->image ?? null,
                        'Size'      => $item->options->Size ?? null,
                        'color_id'  => $item->options->image->color_id
                            ?? $item->options->Variantdata->color_id
                            ?? null,
                    ],
                ];
            }

            session([
                'checkout_data' => $request->all(),
                'cart_total' => $total,
                'cart_data' => $cartArray
            ]);

            Log::info('Session data stored', [
                'checkout_data_keys' => array_keys($request->all()),
                'cart_items_stored' => count($cartArray)
            ]);

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

            // Convert total to paise (multiply by 100) and handle comma-separated values
            $cleanTotal = (float) str_replace(',', '', $total);
            $amountInPaise = (int) round($cleanTotal * 100);


            Log::info('Creating Razorpay order', [
                'amount_in_paise' => $amountInPaise,
                'clean_total' => $cleanTotal
            ]);

            // Create a Razorpay order
            $razorpayOrder = $api->order->create([
                'receipt' => 'rcptid_' . uniqid(),
                'amount' => $amountInPaise,
                'currency' => 'INR',
                'payment_capture' => 1
            ]);

            Log::info('Razorpay order created successfully', [
                'razorpay_order_id' => $razorpayOrder['id']
            ]);

            return view('frontend.razorpay', [
                'orderId' => $razorpayOrder['id'],
                'razorpayKey' => config('services.razorpay.key'),
                'amount' => $razorpayOrder['amount'],
                'currency' => $razorpayOrder['currency'],
                'customerName' => $request->fname . ' ' . $request->lname,
                'customerEmail' => $request->email
            ]);
        } catch (ValidationValidationException $e) {
            Log::warning('Validation failed during razorpay checkout', [
                'errors' => $e->errors()
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors()
                ], 422);
            }

            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            Log::error('Failed to create Razorpay order', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Failed to initialize payment. Please try again.'
                ], 500);
            }

            return back()->with('error', 'Failed to initialize payment. Please try again.');
        }
    }

    public function paymentSuccess(Request $request)
    {
        try {
            // Verify the payment signature
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Payment is verified, now create the order
            DB::beginTransaction();

            // Get checkout data from session
            $checkoutData = session('checkout_data');
            $cartTotal = session('cart_total');
            $cartData = session('cart_data');

            if (!$checkoutData || !$cartData) {
                throw new Exception('Session data not found. Please try checkout again.');
            }

            if (!Auth::check()) {
                $user = "Guest/Dummy Order";
            } else {
                $user = Auth::user()->email;
            }

            // Create order
            $order = new Order();
            $order->invoice_id = 'INV-' . uniqid();
            $order->txn_id = $request->razorpay_payment_id;
            $order->user_id = $user;
            $order->name = $checkoutData['fname'] . ' ' . $checkoutData['lname'];
            $order->price = $cartTotal;
            $order->total = $cartTotal;
            $order->shipping = 0.00;
            $order->delivery_status = "In-transit"; // Since payment is successful
            $order->payment_status = "Paid";
            $order->payment_method = "Razorpay";
            $order->save();

            $order->order_id = 'E-comm:' . $order->id;
            $order->save();

            // Create order items
            foreach ($cartData as $data) {
                $items = new OrderItem();
                $items->order_id = $order->id;
                $items->product_id = $data['id'];
                $items->user_id = $user;
                $items->sku = "SKU-ABC";
                $items->product_name = $data['name'];
                $items->quantity = $data['qty'];
                $items->price = $data['price'];
                $items->image = $data['options']['image']['name'] ?? null;
                $items->color_id = $data['options']['color_id'] ?? null;
                $items->save();
            }

            // Create delivery info
            $delivery = new DeliveryInfo();
            $delivery->order_id = $order->id;
            $delivery->user_id = $user;
            $delivery->fname = $checkoutData['fname'];
            $delivery->lname = $checkoutData['lname'];
            $delivery->email = $checkoutData['email'];
            $delivery->address = $checkoutData['address'];
            $delivery->country = $checkoutData['country'];
            $delivery->state = $checkoutData['state'];
            $delivery->pincode = $checkoutData['postalcode'];
            $delivery->save();

            // Create billing info
            $billing = new BillingInfo();
            $billing->order_id = $order->id;
            $billing->user_id = $user;
            $billing->fname = $checkoutData['billing_fname'] ?? $checkoutData['fname'];
            $billing->lname = $checkoutData['billing_lname'] ?? $checkoutData['lname'];
            $billing->email = $checkoutData['billing_email'] ?? $checkoutData['email'];
            $billing->address = $checkoutData['billing_address'] ?? $checkoutData['address'];
            $billing->country = $checkoutData['billing_country'] ?? $checkoutData['country'];
            $billing->state = $checkoutData['billing_state'] ?? $checkoutData['state'];
            $billing->pincode = $checkoutData['billing_postalcode'] ?? $checkoutData['postalcode'];
            $billing->save();

            // Clear cart and session data
            Cart::destroy();
            session()->forget(['checkout_data', 'cart_total', 'cart_data']);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Payment successful and order created!',
                'order_id' => $order->order_id,
                'redirect_url' => route('order.success.page')
            ]);
        } catch (SignatureVerificationError $e) {
            DB::rollBack();
            Log::error('Payment signature verification failed', ['message' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Payment verification failed'
            ], 400);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to create order after payment', ['message' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Payment successful but failed to create order. Please contact support.'
            ], 500);
        }
    }

    public function ordersuccessMsg()
    {
        return view('frontend.orderConfirmationPage');
    }
}
