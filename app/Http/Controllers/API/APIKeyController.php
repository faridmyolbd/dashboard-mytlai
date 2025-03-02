<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIKeyController extends Controller
{
    // API Base URL
    private $apiBaseUrl = 'https://api.verbex.ai/v1/api-keys/';
    private $apiKey = 'API_0ZoGgnycKTJ5MmfFa8IMNNqWcgOnNq0yoJdgwKYSYFysXFgiXtoGkWr2HZyrB7Vu';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apiUrl = env('API_BASE_URL', 'https://api.verbex.ai/v1/api-keys/');
        $apiToken = env('API_TOKEN');

        // Make API Request
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiToken,
        ])->get($apiUrl);

        // Check if the API call was successful
        if ($response->failed()) {
            return view('api_keys.index', ['apiKeys' => [], 'error' => 'Failed to fetch API keys.']);
        }

        $data = $response->json();

        // Extract API keys data
        $apiKeys = $data['data'] ?? [];

        return view('api_keys.index', compact('apiKeys'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('api_keys.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = Http::post($this->apiBaseUrl, $request->all());

        if ($response->successful()) {
            return redirect()->route('api-keys.index')->with('success', 'API Key created successfully.');
        }

        return back()->withErrors(['error' => 'Failed to create API Key']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $response = Http::get("{$this->apiBaseUrl}{$id}");
        $apiKey = $response->json();

        return view('api_keys.show', compact('apiKey'));
    }

    /**
     * Revoke the specified API Key.
     */
    public function revoke($id)
    {
        $response = Http::post("{$this->apiBaseUrl}{$id}/revoke");

        if ($response->successful()) {
            return redirect()->route('api-keys.index')->with('success', 'API Key revoked successfully.');
        }

        return back()->withErrors(['error' => 'Failed to revoke API Key']);
    }
}
