<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $apiKey = env('GEMINI_API_KEY');
        $contents = $request->input('contents');

        if (!$apiKey) return response()->json(['error' => 'Falta API Key'], 500);

        try {
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
                    'contents' => $contents
                ]);
            return $response->json();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error de conexión'], 500);
        }
    }
}