<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\cart;
use App\Models\CartDetail;
use App\Http\Requests\StorecartRequest;
use App\Http\Requests\UpdatecartRequest;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $cart = Cart::with('details.book')->where('user_id', auth()->id())->first();

    return view('user.cart', [
        'cart' => $cart,
        'details' => $cart->details ?? [],
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorecartRequest $request)
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $book = Book::findOrFail($request->book_id);
        $quantity = $request->quantity ?? 1;
        CartDetail::updateOrCreate(
            ['cart_id' => $cart->id, 'buku_id' => $book->id],
            [
                'buku_name' => $book->nama_buku,
                'harga' => $book->harga,
                'quantity' => $quantity,
            ]
        );

        return redirect()->route('cart.index')->with('success', 'Book added to cart!');
    }

    /**
     * Display the specified resource.
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecartRequest $request, cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cart $cart, $id)
    {
        $detail = CartDetail::findOrFail($id);
        $detail->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }
}
