<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    /**
     * Subscribe an email address to the newsletter.
     */
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ], [
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail doit être valide.',
            'email.max' => 'L\'adresse e-mail ne doit pas dépasser 255 caractères.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first('email'),
            ], 422);
        }

        $email = strtolower(trim($request->email));

        // Check for duplicates
        $alreadySubscribed = NewsletterSubscriber::where('email', $email)->exists();
        if ($alreadySubscribed) {
            return response()->json([
                'message' => 'Cette adresse e-mail est déjà inscrite à la newsletter.',
            ], 422);
        }

        // Create subscription
        NewsletterSubscriber::create([
            'email' => $email,
        ]);

        return response()->json([
            'message' => 'Votre inscription à la newsletter a été enregistrée avec succès !',
        ], 200);
    }
}
