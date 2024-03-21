@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Stocks</h2>
    <a href="{{ route('stocks.create') }}" class="btn btn-primary mb-2">Add Stock</a>
    @if ($stocks->isEmpty())
    <p>No stocks found.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
            <tr>
                <td>{{ $stock->id }}</td>
                <td>{{ $stock->product ? $stock->product->name : 'Product Not Found' }}</td>
                <td>{{ $stock->quantity }}</td>
                <td>
                    <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this stock?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
