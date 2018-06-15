<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Models\Location;

/**
 * Description of DocumentTransformer
 *
 * @author kulturman
 */
class LocationTransformer extends TransformerAbstract
{
    
    public function transform(Location $location)
    {
        return [
            'id' => $location->id,
            'name' => $location->name,
            'lng' => $location->lng,
            'lat' => $location->lat,
        ];
    }
    
}
