<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;
use App\Models\Document;
use Illuminate\Support\Facades\DB;

/**
 * Description of Util
 *
 * @author kulturman
 */
class Util
{
    public static function detachLocations($document)
    {
        DB::table('document_location')->where('document_id' , $document)->delete();
    }
    
    public static function detachDocuments($document)
    {
        DB::table('document_parent')->where('document_id' , $document)->delete();
    }
    
    public static function deleteDocument($document)
    {
        self::detachDocuments($document);
        self::detachLocations($document);
        DB::table('documents')->where('id' , $document)->delete();
        DB::table('document_parent')->where('parent_id' , $document)->delete();
    }
    
}
