<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostCallAnalysisController extends Controller
{
    public function show(Request $request, $call_id)
    {
        // Your API URL
        $apiUrl = 'https://api.verbex.ai/v2/ai-agents/67a48c4023078fbf4209ca88/postcall-analysis/results/' . $call_id;

        // Authorization Key
        $apiKey = 'API_0ZoGgnycKTJ5MmfFa8IMNNqWcgOnNq0yoJdgwKYSYFysXFgiXtoGkWr2HZyrB7Vu';

        // Fetch the API response
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get($apiUrl);

        // Decode the JSON response
        $data = $response->json();

        // Extract the relevant data from the API response
        $call_id = $data['data']['call_id'];
        $ai_agent_id = $data['data']['ai_agent_id'];
        $items = $data['data']['items'];

        // $datas = [];
        // if ($items) {
        //   foreach ($items as $key => $value) {
        //     $datas[] = [
        //       'type' => $value['type'],
        //       'result' => $value['result'],
        //     ];
        //   }
        // }
        // 'datas'=> json_encode($datas);

        // Pass the data to the view
        return view('post_call.post-call-analysis', compact('call_id', 'ai_agent_id', 'items'));
    }
}
