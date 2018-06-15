<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ApiController extends Controller
{
    protected $manager;
    
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }
    
    public function respondWithCollection($data , $transformer , $includes = [])
    {
        $resource = new Collection($data , $transformer);
        $this->manager->parseIncludes($includes);
        return response()->json($this->manager->createData($resource)->toArray() , 200);
    }
    
    public function respondWithItem($data , $transformer , $includes = [])
    {
        $resource = new Item($data , $transformer);
        $this->manager->parseIncludes($includes);
        return response()->json($this->manager->createData($resource)->toArray() , 200);
    }
    
    private function respondWithError($errorCode , $message)
    {
        return response()->json(['message' => $message] , $errorCode);
    }
    
    public function errorNotFound()
    {
        return $this->respondWithError(404 , 'La ressource demandée est introuvable');
    }
}
