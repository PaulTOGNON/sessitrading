<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Favorite;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Admin Dashboard Overview
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalOrders = Order::count();
        
        // Sum of products in the database or fallback
        $totalProducts = Product::allStatic()->count();
        
        // Revenue is sum of non-cancelled orders
        $estimatedRevenue = Order::where('status', '!=', 'cancelled')->sum('total_amount');

        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalOrders',
            'totalProducts',
            'estimatedRevenue',
            'recentOrders',
            'recentUsers'
        ));
    }

    /**
     * E-Commerce Analytics (Popular, Favorites, Carts)
     */
    public function analytics()
    {
        $products = Product::allStatic();

        // Calculate dynamic counts
        $analyzed = $products->map(function ($product) {
            $favoritesCount = Favorite::where('product_id', $product->id)->count();
            $cartCount = CartItem::where('product_id', $product->id)->sum('quantity');
            $orderedCount = OrderItem::where('product_id', $product->id)->sum('quantity');

            return [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->price,
                'category' => $product->category,
                'favorites_count' => $favoritesCount,
                'cart_count' => $cartCount,
                'ordered_count' => $orderedCount,
            ];
        });

        // Top 5 popular (ordered)
        $popularProducts = $analyzed->sortByDesc('ordered_count')->take(5)->values()->toArray();

        // Top 5 favorited
        $favoritedProducts = $analyzed->sortByDesc('favorites_count')->take(5)->values()->toArray();

        // Top 5 in active carts
        $activeCartProducts = $analyzed->sortByDesc('cart_count')->take(5)->values()->toArray();

        return view('admin.analytics', compact(
            'popularProducts',
            'favoritedProducts',
            'activeCartProducts'
        ));
    }

    /**
     * User Management
     */
    public function users(Request $request)
    {
        $query = User::query();

        if ($request->has('q') && !empty($request->q)) {
            $q = $request->q;
            $query->where(function($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                  ->orWhere('email', 'like', "%{$q}%")
                  ->orWhere('phone_number', 'like', "%{$q}%")
                  ->orWhere('city', 'like', "%{$q}%");
            });
        }

        $users = $query->latest()->paginate(15);
        $search = $request->q;

        return view('admin.users', compact('users', 'search'));
    }

    /**
     * Update User Info
     */
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'is_admin' => 'required|boolean',
            'is_suspended' => 'required|boolean',
        ]);

        if (Auth::id() === $user->id && (!$request->is_admin || $request->is_suspended)) {
            return back()->with('error', 'Vous ne pouvez pas vous retirer vos droits administrateur ni vous suspendre vous-même !');
        }

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
            'is_admin' => $request->is_admin,
            'is_suspended' => $request->is_suspended,
        ]);

        return back()->with('success', 'Informations de l\'utilisateur mises à jour avec succès.');
    }

    /**
     * Toggle User Suspension
     */
    public function toggleUserStatus(User $user)
    {
        if (Auth::id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas suspendre votre propre compte !');
        }

        $user->is_suspended = !$user->is_suspended;
        $user->save();

        $statusMsg = $user->is_suspended ? 'suspendu' : 'réactivé';
        return back()->with('success', "Le compte de l'utilisateur a été {$statusMsg} avec succès.");
    }

    /**
     * Delete User Account
     */
    public function destroyUser(User $user)
    {
        if (Auth::id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte !');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Compte utilisateur supprimé définitivement.');
    }

    /**
     * Order Management
     */
    public function orders(Request $request)
    {
        $query = Order::with('user', 'items');

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(15);
        $filterStatus = $request->status;

        return view('admin.orders', compact('orders', 'filterStatus'));
    }

    /**
     * Update Order Status
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:pending,confirmed,shipped,delivered,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Le statut de la commande a été mis à jour avec succès.');
    }

    /**
     * Product Management CRUD
     */
    public function products(Request $request)
    {
        $query = Product::query();

        if ($request->has('q') && !empty($request->q)) {
            $q = $request->q;
            $query->where('name', 'like', "%{$q}%")
                  ->orWhere('category', 'like', "%{$q}%");
        }

        $products = $query->latest()->paginate(15);
        $search = $request->q;

        return view('admin.products', compact('products', 'search'));
    }

    /**
     * Store a New Product
     */
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'original_price' => 'nullable|integer|min:0',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_popular' => 'boolean',
            'is_new' => 'boolean',
        ]);

        // Handle image
        $imageName = 'product1.jpeg'; // default fallback
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $imageName = time() . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $imageName);
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'price' => $request->price,
            'original_price' => $request->original_price,
            'image' => $imageName,
            'category' => $request->category,
            'description' => $request->description,
            'stock' => $request->stock,
            'is_popular' => $request->boolean('is_popular'),
            'is_new' => $request->boolean('is_new'),
            'rating' => 5.0,
            'reviews_count' => 0,
        ]);

        return back()->with('success', 'Produit ajouté avec succès.');
    }

    /**
     * Update an Existing Product
     */
    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'original_price' => 'nullable|integer|min:0',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_popular' => 'boolean',
            'is_new' => 'boolean',
        ]);

        $updateData = [
            'name' => $request->name,
            'price' => $request->price,
            'original_price' => $request->original_price,
            'category' => $request->category,
            'description' => $request->description,
            'stock' => $request->stock,
            'is_popular' => $request->boolean('is_popular'),
            'is_new' => $request->boolean('is_new'),
        ];

        // Only regenerate slug if name changed
        if ($product->name !== $request->name) {
            $updateData['slug'] = Str::slug($request->name) . '-' . time();
        }

        // Handle image update
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $imageName = time() . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $imageName);
            $updateData['image'] = $imageName;
        }

        $product->update($updateData);

        return back()->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Delete Product
     */
    public function destroyProduct(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Produit supprimé avec succès.');
    }
}
