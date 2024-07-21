<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AddToCardController extends Controller
{
    use CommonTrait;
    private BaseRepository $repo;
    public function __construct(BaseRepository $repo)
    {
        $this->repo = $repo;
    }
    // Add a product to the cart
    public function add( $id)
    {
        $condition = [
            'sku'=>$id
        ];
        $select = [
            'sku',
            'product_name',
            'selling_price',
            'image'
        ];
       
        $product = $this->repo->getSingleData(
            Product::query(),
            $condition,
            $select

        );
       
        $cart = Session::get('cart', []);

        if (isset($cart[$product->sku])) {
            $cart[$product->sku]['quantity']++;
        } else {
            $cart[$product->sku] = [
                'sku'=>$product->sku,
                "name" => $product->product_name,
                "quantity" => 1,
                "price" => $product->selling_price,
                "image" => $product->image
            ];
        }

        Session::put('cart', $cart);

        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    // Remove a product from the cart
    public function remove($sku)
    {
        if ($sku) {
            $cart = Session::get('cart');

            if (isset($cart[$sku])) {
                unset($cart[$sku]);
                Session::put('cart', $cart);
            }

            return redirect()->back()->with('success', 'Product removed from cart successfully!');
        }
    }
    public function updateQuantity(Request $request){
        // Get the cart from the session
        $cart = session()->get('cart', []);

        // Update the quantity if the item exists in the cart
        if (isset($cart[$request->sku])) {

            $cart[$request->sku]['quantity'] = $request->quantity > 0 ? $request->quantity : $cart[$request->sku]['quantity'] ;
        }

        // Save the updated cart back to the session
        session()->put('cart', $cart);

        // Return a success response
        return response()->json(['success' => true, 'cart' => $cart]);
    }
}
