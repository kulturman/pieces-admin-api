<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Models\Document;
use Illuminate\Support\Facades\App;

/**
 * Description of DocumentTransformer
 *
 * @author kulturman
 */
class DocumentTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['locations' , 'documents'];
    
    public function transform(Document $document)
    {
        return [
            'id' => $document->id,
            'name' => $document->name,
            'details' => $document->details,
            'description' => $document->description,
        ];
    }
    
    public function includeLocations(Document $document)
    {
        return $this->collection($document->locations , App::make(LocationTransformer::class));
    }
    
    public function includeDocuments(Document $document)
    {
        return $this->collection($document->documents , App::make(DocumentTransformer::class));
    }
}
