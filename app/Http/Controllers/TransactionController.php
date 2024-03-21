<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;
use App\Models\Stock;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return view('transactions.index', compact('transactions'));
    }

    public function formBuy()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            // Redirect unauthorized users to the login page
            return redirect()->route('login');
        }
        $products = Product::all();
        return view('transactions.buy', compact('products'));
    }

    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view('transactions.create', compact('users', 'products'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|numeric',
        ]);

        Transaction::create($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function edit(Transaction $transaction)
    {
        $users = User::all();
        $products = Product::all();
        return view('transactions.edit', compact('users', 'products', 'transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        // Validation
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|numeric',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }

    public function buy(Request $request)
    {
        // Validation
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric',
        ]);

        // Get the authenticated user's ID from the session
        $userId = auth()->id();

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Check if the product exists
        $product = Product::findOrFail($productId);

        // Check if the requested quantity is available in stock
        $availableStock = Stock::where('product_id', $productId)->sum('quantity');
        if ($availableStock < $quantity) {
            return back()->with('error', 'Insufficient stock!');
        }

        // Create transaction
        Transaction::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);

        // Reduce the stock quantity
        $stocks = Stock::where('product_id', $productId)->orderBy('created_at')->get();
        foreach ($stocks as $stock) {
            if ($quantity <= $stock->quantity) {
                $stock->update(['quantity' => $stock->quantity - $quantity]);
                break;
            } else {
                $quantity -= $stock->quantity;
                $stock->update(['quantity' => 0]);
            }
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction completed successfully.');
    }
}
