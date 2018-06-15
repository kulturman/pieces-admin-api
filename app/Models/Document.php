<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Document extends Model
{
    use Searchable;
    public $asYouType = true;
    
    public function documents()
    {
        return $this->belongsToMany(Document::class , 'document_parent' , 'document_id' , 'parent_id');
    }
    
    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }
    
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
