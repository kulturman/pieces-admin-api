<div class="location-block" id = "{!! $generatedId !!}" style = "margin-bottom: 10px;">
    <div class = "row">
        <div class = "col-sm-8">
            <label>Nom du document</label>
        </div>
    </div>
    <div class = "row">
        <div class = "col-sm-8">
            <select name = "documents[]" class = "form-control">
                @foreach($documents as $doc)
                    @if(isset($selectedDoc) and $selectedDoc == $doc->id))
                        <option value = "{!! $doc->id !!}" selected="selected">{!! $doc->name !!}</option>
                    @else
                        <option value = "{!! $doc->id !!}">{!! $doc->name !!}</option>
                    @endif()
                @endforeach()
            </select>
        </div>

        <a title="Supprimer" class="btn btn-danger btn-xs delete" data-delete-id = "{!! $generatedId !!}   ">
            Supprimer
        </a>
    </div>
</div>