<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Util;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function deleteDocument($document)
    {
        Util::deleteDocument($document);
        return redirect('/')->with('success' , 'Document supprimé avec succès');
    }
    
    public function createDocument()
    {
        return view('create_document');
    }
    
    public function index()
    {
        return view('documents_list')->withDocuments(\App\Models\Document::all());
    }
    
    public function addNewLocation()
    {
        $generatedId = time();
        return view('partials.new_location' , compact('generatedId'));
    }
    
    public function addExistingLocation()
    {
        $locations = \App\Models\Location::all();
        $generatedId = time();
        return view('partials.existing_location' , compact('generatedId' , 'locations'));
    }
    
    public function saveDocument(Request $request)
    {
        \Illuminate\Support\Facades\DB::transaction(function() use ($request)
        {
            $inputs = $request->all();
            $document = new \App\Models\Document;
            $document->name = $inputs['name'];
            $document->details = $inputs['details'];
            $document->description = $inputs['description'];
            $document->save();
            
            if(isset($inputs['documents']))
            {
               $document->documents()->attach($inputs['documents']);
            }
            
            $this->attachLocations($inputs, $document);
            
        });
        
        return response()->json(['sucess' => true]);
    }
    
    private function detachLocations()
    {
        
    }
    
    private function attachLocations($inputs , \App\Models\Document $document)
    {
        if(isset($inputs['locations']))
        {
            $locations = $inputs['locations'];
            $locationsCoords = $inputs['location_coordonates'];
            foreach($locations as $key => $loc)
            {
                //Il s'agit d'un nouvel emplacement, donc à créer en base d'abord
                if($locationsCoords[$key] !== 'none') 
                {
                    $coordsTokens = explode(';' , $locationsCoords[$key]);
                    $newLocation = new \App\Models\Location;
                    $newLocation->name = $loc;
                    $newLocation->lng = $coordsTokens[0];
                    $newLocation->lat = $coordsTokens[1];
                    $newLocation->save();
                    $document->locations()->attach($newLocation);
                }

                else
                {
                    $document->locations()->attach((int)$loc);
                }
            }
        }
    }
    
    public function addDocument()
    {
        $documents = \App\Models\Document::all();
        $generatedId = time();
        return view('partials.existing_document' , compact('generatedId' , 'documents'));
    }
    
    public function editDocument(\App\Models\Document $document)
    {
        $locations = \App\Models\Location::all();
        $documents = \App\Models\Document::all();
        return view('edit_document' , compact('document' , 'locations' , 'documents'));
    }
    
    public function updateDocument(\App\Models\Document $document , Request $request)
    {
        \Illuminate\Support\Facades\DB::transaction(function() use ($request , $document)
        {
            $inputs = $request->all();
            $document->name = $inputs['name'];
            $document->details = $inputs['details'];
            $document->description = $inputs['description'];
            $document->save();
            Util::detachDocuments($document->id);
            Util::detachLocations($document->id);
            if(isset($inputs['documents']))
            {
               $document->documents()->attach($inputs['documents']);
            }
            
            $this->attachLocations($inputs, $document);
            
        });
        
        return response()->json(['sucess' => true]);
    }
}
