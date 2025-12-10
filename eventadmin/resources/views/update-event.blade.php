@extends('theme1')
@section('contenu')
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Modifier Evenemement </h4>



                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Modification des événements</h4>
                                    <div class="flex-shrink-0">

                                    </div>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
                                        <form action="/update-event" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$data->id}}">
                                            <div class="row gy-4">
    <div>
        <div>
            <label for="titreInput" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titreInput" placeholder="titre" name="titre" value="{{$data->titre}}">
        </div>
    </div>
    <div>
        <div>
            <label for="categorieInput" class="form-label">Catégorie</label>
            <input type="text" class="form-control" id="categorieInput" placeholder="catégorie" name="categorie" value="{{$data->categorie}}">
        </div>
    </div>
    <div>
        <div>
            <label for="descriptionInput" class="form-label">Description</label>
            <textarea class="form-control" id="descriptionInput" placeholder="description" name="description" value="{{$data->description}}"></textarea>
        </div>
    </div>
    <div>
        <div>
            <label for="locationInput" class="form-label">Location</label>
            <input type="text" class="form-control" id="locationInput" placeholder="location" name="location" value="{{$data->location}}">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div>
                <label for="dateDebutInput" class="form-label">Date de début</label>
                <input type="datetime-local" class="form-control" id="dateDebutInput" name="date_debut" value="{{$data->date_debut}}">
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <label for="dateFinInput" class="form-label">Date de fin</label>
                <input type="datetime-local" class="form-control" id="dateFinInput" name="date_fin" value="{{$data->date_fin}}">
            </div>
        </div>
    </div>
    <div>
        <div>
            <label for="imageInput" class="form-label">Image</label>
            <input type="file" class="form-control" id="imageInput" name="image" accept="image/*" value="{{$data->image}}">
        </div>
    </div>
    <div>
            <label for="creeInput" class="form-label">Crée par</label>
            <input type="text" class="form-control" id="creeInput" placeholder="crée par" name="Cree_par">
        </div>
    </div>
</div>
                                                <button type="submit" class="btn btn-primary">Modifier</button>
                                            </div>
</form>
</div>
                                    </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    @endsection('contenu')

