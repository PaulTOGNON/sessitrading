<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the store homepage.
     */
    public function index()
    {
        $all = Product::allStatic();
        
        $popularProducts = $all->where('is_popular', true)->take(4);
        $newProducts = $all->where('is_new', true)->take(4);
        $promoProducts = $all->whereNotNull('original_price')->take(4);
        $allProducts = $all;
        
        // Dynamic categories from static products
        $categories = $all->pluck('category')->unique()->values();

        // Static review system data for home layout
        $reviews = [
            [
                'name' => 'Amina Diallo',
                'avatar' => 'https://images.unsplash.com/photo-1531123897727-8f129e1688ce?w=150&auto=format&fit=crop&q=80',
                'rating' => 5,
                'comment' => 'Les boubous sont magnifiques ! La qualité du tissu est incroyable et les couleurs restent éclatantes.',
                'date' => 'Il y a 2 jours'
            ],
            [
                'name' => 'Koffi Mensah',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80',
                'rating' => 5,
                'comment' => 'Le gilet contemporain taille perfection. Service de livraison rapide et soigné. Je recommande Sessitrading !',
                'date' => 'Il y a 1 semaine'
            ],
            [
                'name' => 'Mariam Soglo',
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&auto=format&fit=crop&q=80',
                'rating' => 4,
                'comment' => 'La robe décontractée est très agréable à porter pour les journées chaudes. Très bon rapport qualité/prix.',
                'date' => 'Il y a 3 semaines'
            ]
        ];

        return view('store.index', compact('popularProducts', 'newProducts', 'promoProducts', 'allProducts', 'categories', 'reviews'));
    }

    /**
     * Display the products listing page.
     */
    public function shop(Request $request)
    {
        $products = Product::allStatic();

        // Search filter
        if ($request->filled('search')) {
            $search = strtolower($request->input('search'));
            $products = $products->filter(function($p) use ($search) {
                return str_contains(strtolower($p->name), $search) ||
                       str_contains(strtolower($p->description), $search) ||
                       str_contains(strtolower($p->category), $search);
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $products = $products->where('category', $request->input('category'));
        }

        // Sorting
        $sort = $request->input('sort', 'latest');
        if ($sort === 'price_asc') {
            $products = $products->sortBy('price');
        } elseif ($sort === 'price_desc') {
            $products = $products->sortByDesc('price');
        } elseif ($sort === 'rating') {
            $products = $products->sortByDesc('rating');
        } else {
            // Default latest (sort by id desc)
            $products = $products->sortByDesc('id');
        }

        $categories = Product::allStatic()->pluck('category')->unique()->values();
        $selectedCategory = $request->input('category');
        $search = $request->input('search');

        return view('store.shop', compact('products', 'categories', 'selectedCategory', 'search', 'sort'));
    }

    /**
     * Display the detailed product page.
     */
    public function show($slug)
    {
        $all = Product::allStatic();
        $product = $all->firstWhere('slug', $slug);

        if (!$product) {
            abort(404);
        }

        $relatedProducts = $all->where('category', $product->category)
            ->where('slug', '!=', $product->slug)
            ->take(4);

        return view('store.show', compact('product', 'relatedProducts'));
    }
}
