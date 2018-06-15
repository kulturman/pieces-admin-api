@extends('layouts.app')

@section('title' , 'Liste des documents')

@section('content')

<div class="container">
    @if(session('success'))
        <div class = "alert alert-block alert-success">
            {!! session('success') !!}
        </div>
    @endif()
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Liste des documents enregistrés</div>
                <div class="card-body">
                    <table class = "table table-bordered table-striped table-hover">
                        <tr>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Ajouté le </th>
                            <th>Actions </th>
                        </tr>
                        @foreach($documents as $document)
                            <tr>
                                <td>{!! $document->name !!}</td>
                                <td>{!! $document->description !!}</td>
                                <td>{!! $document->created_at->format('d/m/Y') !!}</td>
                                <td>
                                    <!--<a class = "btn btn-success">Détails</a>-->
                                    <a class = "btn btn-info"  href="{!! route('edit_document' , [$document->id]) !!}">Modifier</a>
                                    <a class = "btn btn-danger"
                                         href="{!! route('delete_document' , [$document->id]) !!}">
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                        @endforeach()
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection