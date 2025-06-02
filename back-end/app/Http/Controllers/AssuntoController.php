<?php

namespace App\Http\Controllers;

use App\Services\AssuntoService;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Requests\StoreAssuntoRequest;
use App\Http\Requests\UpdateAssuntoRequest;
use Illuminate\Http\JsonResponse;

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
            return throw new \Exception($response['data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        return ApiResponse::success($response['data']);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssuntoRequest $request)
    {
        $response = $this->assuntoService->store($request->all());
        if ($response['error']) {
            return throw new \Exception($response['data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        return ApiResponse::success($response['data'], 'Operação realizada com sucesso', JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $assuntoId)
    {
        $response = $this->assuntoService->show($assuntoId);
        if ($response['error']) {
            return throw new \Exception($response['data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        return ApiResponse::success($response['data']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssuntoRequest $request, int $assuntoId)
    {
        $response = $this->assuntoService->update($assuntoId, $request->all());
        if ($response['error']) {
            return throw new \Exception($response['data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        return ApiResponse::success($response['data']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $assuntoId)
    {
        $response = $this->assuntoService->destroy($assuntoId);
        if ($response['error']) {
            return throw new \Exception($response['data'], JsonResponse::HTTP_BAD_REQUEST);
        }

        return ApiResponse::success($response['data'], "Operação realizada com sucesso", JsonResponse::HTTP_NO_CONTENT);
    }
}
