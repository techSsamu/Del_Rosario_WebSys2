<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all()->map(function ($product) {

            $product->qr = QrCode::size(100)
                ->generate(route('products.show', $product->id));

            return $product;
        });

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'price' => 'required|numeric',
        ]);

        Product::create($request->all());

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created.');
    }

    public function show(Product $product)
    {
        $data = json_encode([
            'id'    => $product->id,
            'name'  => $product->name,
            'price' => $product->price,
        ]);

        $qr = QrCode::size(200)->generate($data);

        $qrImagePath = 'images/qr_' . $product->id . '.svg';

        if (extension_loaded('imagick')) {
            $qrImagePath = 'images/qr_' . $product->id . '.png';
            QrCode::format('png')->size(300)->generate($data, public_path($qrImagePath));
        } else {
            QrCode::format('svg')->size(300)->generate($data, public_path($qrImagePath));
        }

        return view('products.show', compact('product', 'qr', 'qrImagePath'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'  => 'required',
            'price' => 'required|numeric',
        ]);

        $product->update($request->all());

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted.');
    }
}