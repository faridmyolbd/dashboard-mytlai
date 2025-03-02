<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    private $apiToken = 'API_0ZoGgnycKTJ5MmfFa8IMNNqWcgOnNq0yoJdgwKYSYFysXFgiXtoGkWr2HZyrB7Vu';
    private $apiUrl = 'https://api.verbex.ai/v1/calls/';
    private $perPage = 10; // Number of items per page

    public function getCalls(Request $request)
    {
        $searchTerm = $request->input('search');
        $page = $request->input('page', 1);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Content-Type' => 'application/json',
        ])->get($this->apiUrl);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch call logs.']);
        }

        $calls = $response->json()['calls'] ?? [];

        // Apply filtering if search term exists
        if ($searchTerm) {
            $calls = array_filter($calls, function($call) use ($searchTerm) {
                return (stripos($call['_id'], $searchTerm) !== false) ||
                       (stripos($call['ai_agent_id'], $searchTerm) !== false);
            });
        }

        // Calculate pagination
        $total = count($calls);
        $totalPages = ceil($total / $this->perPage);
        $offset = ($page - 1) * $this->perPage;
        $calls = array_slice($calls, $offset, $this->perPage);

        return response()->json([
            'calls' => $calls,
            'pagination' => [
                'total' => $total,
                'per_page' => $this->perPage,
                'current_page' => (int)$page,
                'total_pages' => $totalPages
            ]
        ]);
    }

    public function getConversation(Request $request, $callId)
    {
        $url = $this->apiUrl . $callId;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Content-Type' => 'application/json',
        ])->get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'Failed to fetch conversation data.']);
        }
        return $response->json();
    }
}
