<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FedaPayTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = FedaPayTransaction::with('order.user');

        if ($request->has('q') && !empty($request->q)) {
            $q = $request->q;
            $query->where(function ($w) use ($q) {
                $w->where('transaction_id', 'like', "%{$q}%")
                  ->orWhere('reference', 'like', "%{$q}%")
                  ->orWhere('order_id', 'like', "%{$q}%")
                  ->orWhereHas('order.user', function ($sub) use ($q) {
                      $sub->where('name', 'like', "%{$q}%")
                          ->orWhere('email', 'like', "%{$q}%");
                  });
            });
        }

        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        $transactions = $query->latest()->paginate(15);
        $search = $request->q;
        $filterStatus = $request->status;

        return view('admin.transactions', compact('transactions', 'search', 'filterStatus'));
    }
}
