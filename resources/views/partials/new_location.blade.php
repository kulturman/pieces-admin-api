<div class="location-block" id = "{!! $generatedId !!}" style = "margin-bottom: 10px;">
    <div class = "row">
        <div class = "col-sm-4">
            <label>Nom du lieu</label>
        </div>
        <div class = "col-sm-4">
            <label>Coordonnées(longitude;latitude)</label>
        </div>
    </div>
    <div class = "row">
        <div class = "col-sm-4">
            <input type = "text" class = "form-control" name = "locations[]" />
        </div>

        <div class = "col-sm-4">
            <input type = "text" class = "form-control" name = "location_coordonates[]" />
        </div>
        <a title="Supprimer" class="btn btn-danger btn-xs delete" data-delete-id = "{!! $generatedId !!}   ">
            Supprimer
        </a>
    </div>
</div>