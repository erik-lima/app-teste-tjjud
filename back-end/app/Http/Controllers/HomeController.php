<?php

namespace App\Http\Controllers;

use App\Services\HomeService;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;

class HomeController extends Controller
{
    public function __construct(private HomeService $homeService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $response = $this->homeService->homeData();
        if ($response['error']) {
            return response()->json([
                'error' => true,
                'message' => $response['data']
            ], 400);
        }

        return ApiResponse::success($response['data']);
    }
}
