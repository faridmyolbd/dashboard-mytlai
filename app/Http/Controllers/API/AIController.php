<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    private $apiUrl = 'https://api.verbex.ai/v2/ai-agents/';
    private $apiKey = 'API_0ZoGgnycKTJ5MmfFa8IMNNqWcgOnNq0yoJdgwKYSYFysXFgiXtoGkWr2HZyrB7Vu';

    public function showAgentList()
    {
        // Make the API request
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->get($this->apiUrl);

        // Check if the response was successful and retrieve the agents
        $agents = $response->successful() ? $response->json()['data'] : [];



        // Pass the agents and total agent count to the view
        return view('ai_agents.agents-list', compact('agents'));
    }

    public function getAgentCount()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->get('https://api.verbex.ai/v2/ai-agents');

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch agents data.']);
        }

        $agents = $response->json() ?? [];
        // dd($agents['data'] );
        return count($agents['data']);
    }


}
