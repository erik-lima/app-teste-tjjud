<?php

namespace App\Http\Controllers;

use App\Services\AssuntoService;
use Illuminate\Http\Request;

class AssuntoController extends Controller
{
    public function __construct(private AssuntoService $assuntoService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->query();
        $response = $this->assuntoService->list($filters);
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
        $response = $this->assuntoService->store($request->all());
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
    public function show(int $assuntoId)
    {
        $response = $this->assuntoService->show($assuntoId);
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
    public function update(Request $request, int $assuntoId)
    {
        $response = $this->assuntoService->update($assuntoId, $request->all());
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
    public function destroy(int $assuntoId)
    {
        $response = $this->assuntoService->destroy($assuntoId);
        if ($response['error']) {
            return response()->json([
                'error' => true,
                'message' => $response['data']
            ], 400);
        }

        return response()->json($response);
    }
}
