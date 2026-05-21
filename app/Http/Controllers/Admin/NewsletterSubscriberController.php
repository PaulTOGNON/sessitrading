<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterSubscriberController extends Controller
{
    /**
     * Display a listing of subscribers.
     */
    public function index(Request $request)
    {
        $query = NewsletterSubscriber::query();

        if ($request->has('q') && !empty($request->q)) {
            $q = trim($request->q);
            $query->where('email', 'like', "%{$q}%");
        }

        $subscribers = $query->latest()->paginate(15);
        $search = $request->q;
        $totalCount = NewsletterSubscriber::count();

        return view('admin.newsletter', compact('subscribers', 'search', 'totalCount'));
    }

    /**
     * Remove the specified subscriber from storage.
     */
    public function destroy(NewsletterSubscriber $subscriber)
    {
        $subscriber->delete();

        return back()->with('success', 'Abonné supprimé avec succès de la newsletter.');
    }

    /**
     * Export all subscribers to CSV.
     */
    public function export()
    {
        $headers = [
            'Content-type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename=subscribers_' . date('Y-m-d_H-i-s') . '.csv',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0'
        ];

        $subscribers = NewsletterSubscriber::latest()->get();

        $callback = function() use ($subscribers) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for French system and Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Write CSV Header
            fputcsv($file, ['ID', 'Email', 'Date d\'inscription']);

            foreach ($subscribers as $subscriber) {
                fputcsv($file, [
                    $subscriber->id,
                    $subscriber->email,
                    $subscriber->created_at->format('d/m/Y H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
