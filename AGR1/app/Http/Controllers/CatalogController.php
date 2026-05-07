<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CatalogController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('category')
            ->orderBy('name')
            ->get();

        $planoCliente = ''; // padrão inicial para carregar a tela

        return view('pages.catalogo', compact('products', 'planoCliente'));
    }
}