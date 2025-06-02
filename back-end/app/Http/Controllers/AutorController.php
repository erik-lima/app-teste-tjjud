<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Services\AutorService;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAutorRequest;
use Illuminate\Http\JsonResponse;

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
            return throw new \Exception($response['data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        return ApiResponse::success($response['data']);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAutorRequest $request)
    {
        $response = $this->autorService->store($request->all());
        if ($response['error']) {
            return throw new \Exception($response['data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        return ApiResponse::success($response['data'], "Operação ralizada com sucesso", JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $autorId)
    {
        $response = $this->autorService->show($autorId);
        if ($response['error']) {
            return throw new \Exception($response['data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        return ApiResponse::success($response['data']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAutorRequest $request, int $autorId)
    {
        $response = $this->autorService->update($autorId, $request->all());
        if ($response['error']) {
            return throw new \Exception($response['data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        return ApiResponse::success($response['data']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $autorId)
    {
        $response = $this->autorService->destroy($autorId);
        if ($response['error']) {
            return throw new \Exception($response['data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        return ApiResponse::success($response['data'], "Operação realizada com sucesso", JsonResponse::HTTP_NO_CONTENT);
    }

    public function booksByAuthor(int $cod) {
        $data = $this->autorService->booksByAuthor($cod);
        return ApiResponse::success($data);        
    }
}
