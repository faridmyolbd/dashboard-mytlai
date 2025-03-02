<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\API\AIController;
use App\Http\Controllers\API\CallController;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $callController;
    protected $aiController;

    public function __construct(AIController $aiController,CallController $callController)
    {
        $this->aiController = $aiController;
        $this->callController = $callController;

    }   

    public function index()
    {
        // Fetch dynamic data
        $agentCount = $this->aiController->getAgentCount();
        $callCount = $this->callController->getCallCount();


        // Pass data to the view
        return view('index', compact('agentCount','callCount'));
    }
}
