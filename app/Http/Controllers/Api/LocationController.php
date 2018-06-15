<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use League\Fractal\Manager;
use App\Transformers\LocationTransformer;

class LocationController extends ApiController
{
    public function __construct(Manager $manager , LocationTransformer $transformer) 
    {
        parent::__construct($manager);
        $this->transformer = $transformer;
    }
    
    public function index()
    {
        return $this->respondWithCollection(Location::all() , $this->transformer);
    }
    
    public function show($id)
    {
        $location = Location::where('id' , $id)->first();
        if($location)
        {
            return $this->respondWithItem($location , $this->transformer);
        }
        
        return $this->errorNotFound();
    }
}
