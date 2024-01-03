<?php

namespace App\Http\Controllers;

use App\DataTables\DogsDataTable;
use App\Http\Requests\StoreDogRequest;
use App\Http\Requests\UpdateDogRequest;
use App\Http\Resources\DogCollection;
use App\Models\Dog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DogsDataTable $dataTable) : mixed
    {
        return $dataTable->render('index_dogs');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : mixed
    {
        return view('add_dog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDogRequest $request) : JsonResponse
    {
        if (!$request->wantsJson()) {
            return $this->getBadRequestResponse();
        }
        $dog = Dog::create($request->all());
        return $this->getDogRequestResponse($dog, 'Dog Store Successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dog $dog) : void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dog $dog) : void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDogRequest $request, Dog $dog) : JsonResponse
    {
        if (!$request->wantsJson()) {
            return $this->getBadRequestResponse();
        }
        try {
            $dog->update($request->all());
            return $this->getDogRequestResponse($dog, 'Dog Updated Successfully');
        } catch (\Exception $error) {
            return $this->getBadRequestResponse('Error updating dog', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dog $dog): JsonResponse
    {
        Dog::destroy($dog->id);
        return $this->getDogRequestResponse($dog, 'Dog Deleted Successfully');
    }

    /**
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    private function getBadRequestResponse($message = 'Bad Request', int $code = Response::HTTP_BAD_REQUEST)  :JsonResponse {
        return new JsonResponse([
            'success' => false,
            'message' => $message
        ], $code);
    }

    /**
     * @param Dog $dog
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    private function getDogRequestResponse(Dog $dog, $message = 'Successful', int $code = Response::HTTP_OK) :JsonResponse {
        return new JsonResponse([
            'success' => true,
            'dog' => $dog->toArray(),
            'message' => $message
        ], $code);
    }
}
