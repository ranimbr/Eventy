@extends('theme')
@section('contenu')
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Ajouter Utilisateur</h4>

                               

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Input Example</h4>
                                    <div class="flex-shrink-0">
                                        <div class="form-check form-switch form-switch-right form-switch-md">
                                            <label for="form-grid-showcode" class="form-label text-muted">Show Code</label>
                                            <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
                                        </div>
                                    </div>
                                </div><!-- end card header -->
                                <div class="card-body">
    <div class="live-preview">
        <form action="/addUser" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="row gy-4">
            <!-- Nom Field -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="nomInput" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nomInput" placeholder="Entrez le nom" required name="nom">
                </div>
            </div>
            <!--end col-->

            <!-- Prénom Field -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="prenomInput" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenomInput" placeholder="Entrez le prénom" name="prenom" required>
                </div>
            </div>
            <!--end col-->

            <!-- Statut Field -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="statutSelect" class="form-label">Statut</label>
                    <select class="form-select" id="statutSelect" required name="statut">
    <option value="" selected disabled>Choisir un statut</option>
    <option value="etudiant">Etudiant</option>
    <option value="professionnel">Professionnel</option>
    <option value="enseignant">Enseignant</option>
    <option value="autre">Autre</option>
</select>
                </div>
            </div>
            <!--end col-->

            <!-- Photo Field -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="photoUpload" class="form-label">Photo</label>
                    <input type="file" class="form-control" id="photoUpload" accept="image/*" name="image">
                    <small class="text-muted">Formats acceptés: JPG, PNG (Max 2MB)</small>
                </div>
            </div>
            <!--end col-->
        </div>

    </div>

</div>

                                            </div>
                                            <div class="col-12 mt-3">
    <button type="submit" class="btn btn-primary">Ajouter </button>
</form>
</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
@endsection('contenu')

