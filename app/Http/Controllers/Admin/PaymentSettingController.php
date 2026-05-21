<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $settings = PaymentSetting::getSettings();
        return view('admin.payment-settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'is_enabled' => 'boolean',
            'environment' => 'required|in:sandbox,live',
            'public_key' => 'nullable|string|max:255',
            'secret_key' => 'nullable|string|max:255',
            'webhook_secret' => 'nullable|string|max:255',
            'currency' => 'required|string|size:3',
        ]);

        $settings = PaymentSetting::getSettings();
        $settings->update([
            'is_enabled' => $request->has('is_enabled'),
            'environment' => $request->environment,
            'public_key' => $request->public_key,
            'secret_key' => $request->secret_key,
            'webhook_secret' => $request->webhook_secret,
            'currency' => strtoupper($request->currency),
        ]);

        // Clear laravel cache to ensure new settings are picked up immediately
        Artisan::call('cache:clear');
        Artisan::call('config:clear');

        return redirect()->route('admin.payment-settings.index')
            ->with('success', 'Configurations de paiement mises à jour avec succès.');
    }
}
