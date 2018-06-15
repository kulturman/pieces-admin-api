<div class="location-block" id = "{!! $generatedId !!}" style = "margin-bottom: 10px;">
    <div class = "row">
        <div class = "col-sm-8">
            <label>Nom du lieu</label>
        </div>
    </div>
    <div class = "row">
        <div class = "col-sm-8">
            <select name = "locations[]" class = "form-control">
                @foreach($locations as $loc)
                    @if(isset($selectedLocation) and $selectedLocation == $loc->id))
                        <option value = "{!! $loc->id !!}" selected="selected">{!! $loc->name !!}</option>
                    @else
                        <option value = "{!! $loc->id !!}">{!! $loc->name !!}</option>
                    @endif()
                @endforeach()
            </select>
        </div>
        
        <div class = "col-sm-4" style = "display:none;">
            <input type = "text" class = "form-control" name = "location_coordonates[]" value = "none"/>
        </div>

        <a title="Supprimer" class="btn btn-danger btn-xs delete" data-delete-id = "{!! $generatedId !!}   ">
            Supprimer
        </a>
    </div>
</div>