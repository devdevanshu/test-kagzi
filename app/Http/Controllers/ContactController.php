<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Store a new contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Log the incoming request for debugging
        Log::info('Contact form submitted', $request->all());

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'service' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Save contact data to database
            $contact = Contact::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->service ?: 'Contact Form Submission',
                'message' => $request->message,
                'ip_address' => $request->ip(),
            ]);

            // Example of sending email (uncomment when mail is configured):
            /*
            Mail::send('emails.contact', $request->all(), function ($message) use ($request) {
                $message->to('info@kagziinfotech.com')
                        ->subject('New Contact Form Submission')
                        ->from($request->email, $request->first_name . ' ' . $request->last_name);
            });
            */

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We will get back to you soon.',
                'contact_id' => $contact->id
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error processing your request. Please try again later.'
            ], 500);
        }
    }

    /**
     * Display all contact submissions (for admin use).
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Contact::where('archived', false)->latest();
        
        // Apply search filter
        if ($request->input('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%")
                  ->orWhere('message', 'LIKE', "%$search%");
        }
        
        // Apply date filter
        if ($request->input('date_filter')) {
            $filter = $request->input('date_filter');
            if ($filter === 'today') {
                $query->whereDate('created_at', today());
            } elseif ($filter === 'week') {
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($filter === 'month') {
                $query->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
            }
        }
        
        $contacts = $query->get();

        // If it's an AJAX request, return JSON
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'contacts' => $contacts
            ]);
        }

        // Calculate statistics (only non-archived)
        $totalMessages = Contact::where('archived', false)->count();
        $todayMessages = Contact::where('archived', false)->whereDate('created_at', today())->count();
        $weekMessages = Contact::where('archived', false)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        // Otherwise return the view
        return view('contacts', compact('contacts', 'totalMessages', 'todayMessages', 'weekMessages'));
    }

    /**
     * Show archived messages
     */
    public function archived(Request $request)
    {
        $query = Contact::where('archived', true)->latest();
        
        // Apply search filter
        if ($request->input('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%")
                  ->orWhere('message', 'LIKE', "%$search%");
        }
        
        $contacts = $query->get();
        
        // Calculate statistics for archived messages
        $totalMessages = Contact::where('archived', true)->count();
        $todayMessages = Contact::where('archived', true)->whereDate('created_at', today())->count();
        $weekMessages = Contact::where('archived', true)->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        return view('contacts.archived', compact('contacts', 'totalMessages', 'todayMessages', 'weekMessages'));
    }

    /**
     * Archive a contact message
     */
    public function archive($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['archived' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Message archived successfully'
        ]);
    }

    /**
     * Unarchive a contact message
     */
    public function unarchive($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['archived' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Message restored successfully'
        ]);
    }

    /**
     * Send reply email to contact
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::findOrFail($id);

        try {
            \Mail::send('emails.contact-reply', [
                'originalMessage' => $contact,
                'replyMessage' => $request->message,
            ], function ($message) use ($contact, $request) {
                $message->to($contact->email, $contact->name)
                       ->subject($request->subject)
                       ->from(config('mail.from.address'), config('mail.from.name'));
            });

            return response()->json([
                'success' => true,
                'message' => 'Reply sent successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send reply: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display a specific contact submission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        return response()->json([
            'success' => true,
            'contact' => $contact
        ]);
    }
}
