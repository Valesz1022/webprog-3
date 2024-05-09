<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('shop', compact('books'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1|max:5',
            'postal_code' => 'required|digits:4',
            'city' => 'required|string',
            'street' => 'required|string',
            'house_number' => 'required|string'
        ]);

        $order = new Order();
        $order->book_id = $request->book_id;
        $order->quantity = $request->quantity;

        $book = Book::findOrFail($request->book_id);
        $order->total_price = $request->quantity * $book->ar;

        $order->shipping_address = "{$request->postal_code}, {$request->city}, {$request->street} utca {$request->house_number}.";
        
        $order->user_id = auth()->id();

        $order->save();

        return redirect()->route('shop')->with('alert', 'Rendelés sikeresen elküldve!');
    }

    public function myOrders()
    {
        $user = auth()->user(); 
        $orders = Order::where('user_id', $user->id)->get();
        return view('my_order', compact('orders'));
    }

    public function adminOrders()
    {
        $orders = Order::with(['user', 'book'])->get();
        return view('adminorders', compact('orders'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|in:Feldolgozás alatt,Összekészítés,Szállítás'
        ]);

        $order = Order::findOrFail($request->order_id);
        if ($order->status !== $request->status) {
            $order->status = $request->status;
            $order->save();
            return redirect()->route('adminorders')->with('alert', 'Állapot frissítve.');
        } else {
            return redirect()->route('adminorders')->with('alert', 'Nem történt változtatás az állapoton.');
        }
    }

    public function deleteOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id'
        ]);

        $order = Order::findOrFail($request->order_id);
        $order->delete();
        return redirect()->route('adminorders')->with('alert', 'Rendelés törölve.');
    }

}
