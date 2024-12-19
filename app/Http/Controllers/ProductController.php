<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Listar todos os produtos
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Mostrar formulário para criar um novo produto
    public function create()
    {
        return view('products.create');
    }

    // Armazenar um novo produto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'amount' => 'required|integer',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso.');
    }

    // Mostrar detalhes de um produto
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Mostrar formulário para editar um produto
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Atualizar um produto
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'amount' => 'required|integer',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso.');
    }

    // Deletar um produto
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produto deletado com sucesso.');
    }
}
