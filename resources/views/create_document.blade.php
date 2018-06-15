@extends('layouts.app')

@section('title' , 'Ajouter un document')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ajouter un document</div>
                <div class="card-body">
                    <form method="POST" id = "creation-form">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nom du document</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                       name="name" value="{{ old('name') }}" autofocus>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="details" class="col-md-4 col-form-label text-md-right">Détails</label>
                            <div class="col-md-8">
                                {!! Form::textarea('details', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('details'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('details') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                            <div class="col-md-8">
                                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                                @if ($errors->has('description'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <center>
                                <h3>Lieux d'établissement du document</h3>
                                <hr>
                            </center>
                            <div id = "locations">
                                
                            </div>
                            <center>
                                <a href = "" class = "btn btn-primary" id = "add-location">
                                    Ajouter un lieu
                                </a>
                            </center>
                        </div><br>
                        
                        <div>
                            <center>
                                <h3>Documents liés</h3>
                                <hr>
                            </center>
                            <div id = "documents">
                                
                            </div>
                            <center>
                                <a href = "" class = "btn btn-primary" id = "add-document">
                                    Ajouter un document
                                </a>
                            </center>
                        </div><br>

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-lg" id = "submit">
                                    Valider
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class = "col-md-4">
            <input type = "text" class = "form-control" id = "search_map"/><br/>

            <div id ="map" style ="height:500px;">
            </div>
            
            <p>
                Cordonnées: <span><strong id = "coords"></strong></span>
            </p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
{!! Html::script('libs/tinymce/jquery.tinymce.min.js') !!}
{!! Html::script('libs/tinymce/tinymce.min.js') !!}
{!! Html::script('js/tinymce_init.js') !!}
<script>
    var lng = {!! config('gmap.default_lat') !!}
    ;
            var lat = {!! config('gmap.default_lng') !!}
    ;
    $(function ()
    {
        $.ajaxSetup(
            {
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            }
        );

        $('#add-document').click(function(e)
        {
            e.preventDefault();
            $.ajax({
                url : 'add_document',
                dataType : 'html'
            })
            .done(function(data)
            {
                $('#documents').append(data);
            });
        });
        
        $('#add-location').click(function (e)
        {
            e.preventDefault();
            Swal({
                title: 'Information',
                text: 'De quel type d\'emplacement s\'agit-il?',
                type: 'info',
                showCancelButton: true,
                confirmButtonText: 'nouvel emplacement',
                cancelButtonText: 'Emplacement existant'
            }).then((result) => {
                if (result.value) {
                    var url = 'add_new_location'
                } else {
                    var url = 'add_existing_location';
                }
                
                $.ajax({
                    url : url,
                    dataType : 'html'
                })
                .done(function(data)
                {
                    $('#locations').append(data);
                });
            })
        });
        
        $('#locations,#documents').on('click' , '.delete' , function(e)
        {
            var id = $(this).attr('data-delete-id');
            $('#' + id).remove();
        });
        
        $('#submit').click(function(e)
        {
           e.preventDefault();
           $.ajax({
                url : 'create_document',
                dataType : 'json',
                method : 'POST',
                data: $('#creation-form').serialize()
            })
            .done(function(data)
            {
                swal(
                    'Succès',
                    'Document créé avec succès!',
                    'success'
                  );
                $('#creation-form').trigger('reset');
                $('.location-block').remove();
            })
            .fail(function(data)
            {
                swal(
                    'Echec!',
                    'Une erreur est survenue',
                    'error'
                  );
            }); 
        });
    })

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFbBg5s4QA4D3f3MLw8DcIlx0RVAHj5_o&libraries=places&callback=initMap"
async defer></script>
{!! Html::script('js/map.js') !!}
@endsection()
