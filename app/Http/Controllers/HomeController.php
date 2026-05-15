<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class HomeController extends Controller
{
    public function index()
    {
        ## show 3 featured rooms on the homepage
        $featured = Room::where('available', true)
                        ->orderBy('price', 'desc')
                        ->take(3)
                        ->get();

        return view('home', compact('featured'));
    }

    public function restaurant()
    {
        return view('restaurant');
    }

    ## public function gallery()
    ## {
    ##     return view('gallery');
    ## }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|min:2',
            'email'   => 'required|email',
            'message' => 'required|min:10',
        ], [
            'name.required'    => 'Veuillez entrer votre nom.',
            'email.required'   => 'L\'adresse email est obligatoire.',
            'email.email'      => 'Veuillez entrer une adresse email valide.',
            'message.required' => 'Le message est obligatoire.',
            'message.min'      => 'Votre message doit contenir au moins 10 caractères.',
        ]);

        return redirect()->route('contact')
                         ->with('success', 'Votre message a été envoyé. Nous vous répondrons dans les 24h.');
    }
}