<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email|unique:newsletter_subscribers']);

        NewsletterSubscriber::create(['email' => $request->email]);

        return back()->with('success', 'Thanks for subscribing!');
    }

    public function list()
    {
        $subscribers = NewsletterSubscriber::latest()->paginate(10);
        return view('admin.newsletter.list', compact('subscribers')); // ✅ This is correct
    }

    public function bulkForm()
    {
        return view('admin.newsletter.bulk');
    }

    public function sendBulkMail(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $subscribers = NewsletterSubscriber::all();

        foreach ($subscribers as $subscriber) {
            Mail::send([], [], function ($message) use ($request, $subscriber) {
                $message->to($subscriber->email)
                    ->subject($request->subject)
                    ->html($request->message);
            });
        }

        return back()->with('success', 'Newsletter sent successfully!');
    }

    public function destroy($id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);
        $subscriber->delete();

        return back()->with('success', 'Subscriber deleted successfully.');
    }

    public function exportCsv()
    {
        $fileName = 'subscribers.csv';

        // ✅ Use the correct model
        $subscribers = NewsletterSubscriber::select('email', 'created_at')->latest()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        $callback = function () use ($subscribers) {
            $file = fopen('php://output', 'w');

            // Header row
            fputcsv($file, ['Email', 'Subscribed At']);

            // Data rows
            foreach ($subscribers as $subscriber) {
                fputcsv($file, [
                    $subscriber->email,
                    $subscriber->created_at->format('d-m-Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
