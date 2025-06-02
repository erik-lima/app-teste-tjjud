<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Services\AutorService;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;

class AutorController extends Controller
{
    public function __construct(private AutorService $autorService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->query() ?? [];
        $response = $this->autorService->list($filters);
        if ($response['error']) {
            return response()->json([
                'error' => true,
                'message' => $response['data']
            ], 400);
        }

        return response()->json($response);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = $this->autorService->store($request->all());
        if ($response['error']) {
            return response()->json([
                'error' => true,
                'message' => $response['data']
            ], 400);
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $autorId)
    {
        $response = $this->autorService->show($autorId);
        if ($response['error']) {
            return response()->json([
                'error' => true,
                'message' => $response['data']
            ], 400);
        }

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $autorId)
    {
        $response = $this->autorService->update($autorId, $request->all());
        if ($response['error']) {
            return response()->json([
                'error' => true,
                'message' => $response['data']
            ], 400);
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $autorId)
    {
        $response = $this->autorService->destroy($autorId);
        if ($response['error']) {
            return response()->json([
                'error' => true,
                'message' => $response['data']
            ], 400);
        }

        return response()->json($response);
    }

    public function booksByAuthor(int $cod) {
        $data = $this->autorService->booksByAuthor($cod);
        return ApiResponse::success($data);        
    }
}
