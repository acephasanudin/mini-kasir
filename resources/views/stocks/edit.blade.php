@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Stock</h2>
    <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="product_id">Product</label>
            <select class="form-control" id="product_id" name="product_id">
                @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ $product->id == $stock->product_id ? 'selected' : '' }}>{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $stock->quantity }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection