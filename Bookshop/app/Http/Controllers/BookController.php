<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Book;

class BookController extends Controller
{
    public function delete(Request $request, $id)
    {
        $hasOrders = Order::where('book_id', $id)->exists();
    
        if ($hasOrders) {
            return redirect()->route('delete_books')->with('alert', 'A könyv nem törölhető, mert rendeléshez van hozzárendelve.');
        }
    
        $book = Book::findOrFail($id);
    
        if (Storage::disk('public')->exists('images/' . $book->kep)) {
            Storage::disk('public')->delete('images/' . $book->kep);
        }
    
        $book->delete();
    
        return redirect()->route('books')->with('alert', 'A könyv sikeresen törölve lett.');
    }


    public function deleteBooks()
    {
        $books = Book::all();
        return view('delete_book', compact('books'));
    }

    public function index()
    {
        $books = Book::all();
        return view('books', compact('books'));
    }

    public function showDeleteForm()
    {
        $books = Book::all();
        return view('books', compact('books'));
    }

    public function uploadBook(Request $request)
    {
        $request->validate([
            'cim' => 'required|string|max:100',
            'szerzo' => 'required|string|max:40',
            'kiado' => 'required|string|max:30',
            'kiadas_eve' => 'required|integer',
            'ar' => 'required|numeric|min:0',
            'kep' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->kep->extension();
        $request->kep->move(public_path('images'), $imageName);

        $book = new Book();
        $book->cim = $request->cim;
        $book->szerzo = $request->szerzo;
        $book->kiado = $request->kiado;
        $book->kiadas_eve = $request->kiadas_eve;
        $book->ar = $request->ar;
        $book->kep = $imageName;
        $book->save();

        return redirect()->back()->with('alert', 'Könyv sikeresen feltöltve!');
    }

    public function showUpdateForm()
    {
        $books = Book::all();
        return view('update_book', compact('books'));
    }



    public function update(Request $request)
    {
        foreach ($request->input('books') as $bookData) {
            $book = Book::findOrFail($bookData['id']);
            $book->update($bookData);
        }

        return redirect()->back()->with('alert', 'Books updated successfully.');
    }
}
