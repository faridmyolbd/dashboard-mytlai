<?php

namespace App\Http\Controllers;

use App\Models\l3m_sales;
use App\Models\product_infrastructure;
use App\Models\rtm_infrastructure;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function fetchData()
    {
        try {
            $tableOneData   = l3m_sales::all();
            $tableTwoData   = product_infrastructure::all();
            $tableThreeData = rtm_infrastructure::all();

            // Return data as JSON
            return response()->json([
                'status' => 'success',
                'data' => [
                    'table_one'   => $tableOneData,
                    'table_two'   => $tableTwoData,
                    'table_three' => $tableThreeData
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
