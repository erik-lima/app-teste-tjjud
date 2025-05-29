<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLivroRequest;
use App\Models\Livro;
use Illuminate\Http\Request;
use App\Services\LivroService;

class LivroController extends Controller
{
    public function __construct(private LivroService $livroService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->livroService->list([]);
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
    public function store(StoreLivroRequest $request)
    {
        $response = $this->livroService->store($request->validated());
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
    public function show(int $livroId)
    {
        $response = $this->livroService->show($livroId);
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
    public function update(Request $request, int $livroId)
    {
        $response = $this->livroService->update($livroId, $request->all());
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
    public function destroy(int $livroId)
    {
        $response = $this->livroService->destroy($livroId);
        if ($response['error']) {
            return response()->json([
                'error' => true,
                'message' => $response['data']
            ], 400);
        }

        return response()->json($response);
    }
}
