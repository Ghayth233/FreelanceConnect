<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactFormSubmitted;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    /**
     * Affiche le formulaire de contact
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();
        $defaults = [];
        
        if ($user) {
            $defaults = [
                'name' => $user->name,
                'email' => $user->email,
            ];
        }
        
        return view('contact', compact('defaults'));
    }

    /**
     * Traite la soumission du formulaire de contact
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => [
                'required',
                'string',
                Rule::in(['question', 'support', 'billing', 'partnership', 'other']),
            ],
            'message' => 'required|string|min:10|max:2000',
        ]);

        // Enregistrer le message dans la base de données
        $contactMessage = new ContactMessage();
        $contactMessage->name = $validated['name'];
        $contactMessage->email = $validated['email'];
        $contactMessage->subject = $validated['subject'];
        $contactMessage->message = $validated['message'];
        $contactMessage->user_id = Auth::id();
        $contactMessage->save();

        // Envoyer l'email de notification
        try {
            Mail::to(env('MAIL_FROM_ADDRESS', 'contact@example.com'))
                ->send(new ContactFormSubmitted($validated));
                
            $status = 'success';
            $message = 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.';
        } catch (\Exception $e) {
            // En cas d'erreur d'envoi d'email, on enregistre quand même le message
            $status = 'warning';
            $message = 'Votre message a été enregistré, mais une erreur est survenue lors de l\'envoi de l\'email. Notre équipe vous contactera dès que possible.';
            \Log::error('Erreur d\'envoi d\'email de contact: ' . $e->getMessage());
        }

        return redirect()->back()->with($status, $message);
    }
}
