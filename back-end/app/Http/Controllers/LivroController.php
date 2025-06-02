<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use App\Http\Resources\LivroResource;
use Illuminate\Http\Request;
use App\Services\LivroService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class LivroController extends Controller
{
    public function __construct(private LivroService $livroService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->query();
        $response = $this->livroService->list($filters);
        if ($response['error']) {
            throw new \RuntimeException($response['error']);
        }

        $response['data'] = LivroResource::collection($response['data']);
        return ApiResponse::success($response['data']);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLivroRequest $request)
    {
        $response = $this->livroService->store($request->validated());
        if ($response['error']) {
            return throw new \Exception($response['data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        return ApiResponse::success($response['data'], "Operação ralizada com sucesso", JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $livroId)
    {
        $response = $this->livroService->show($livroId);
        if ($response['error']) {
            return throw new \Exception($response['data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        return ApiResponse::success($response['data']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLivroRequest $request, int $livroId)
    {
        $response = $this->livroService->update($livroId, $request->validated());
        if ($response['error']) {
            throw new \RuntimeException($response['error']);
        }

        return ApiResponse::success($response['data']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $livroId)
    {
        $response = $this->livroService->destroy($livroId);
        if ($response['error']) {
            return throw new \Exception($response['data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        return ApiResponse::success($response['data'], "Operação ralizada com sucesso", JsonResponse::HTTP_NO_CONTENT);
    }
}
