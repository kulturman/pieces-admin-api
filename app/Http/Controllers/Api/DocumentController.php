<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use League\Fractal\Manager;
use App\Transformers\DocumentTransformer;
use App\Models\Document;

class DocumentController extends ApiController
{
    protected $transformer;
    
    public function __construct(Manager $manager , DocumentTransformer $transformer) 
    {
        parent::__construct($manager);
        $this->transformer = $transformer;
    }
    
    public function index(Request $request)
    {
        $includes = 'documents,locations';
        return $this->respondWithCollection(Document::all() , $this->transformer , 
            $includes
        );
    }
    
    public function show($id , Request $request)
    {
        $includes = 'documents,locations';
        $document = Document::where('id' , $id)->first();
        if($document)
        {
            return $this->respondWithItem($document , $this->transformer , $includes);
        }
        
        return $this->errorNotFound();
    }
    
    public function search(Request $request)
    {
        $includes = 'documents,locations';
        $data = Document::search($request->input('query'))->get();
        return $this->respondWithCollection($data, $this->transformer , $includes);
    }
}
