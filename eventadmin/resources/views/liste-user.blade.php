@extends('theme')

@section('contenu')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Liste Utilisateur</h4>
              
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Liste des utilisateurs</h4>
                    <div class="flex-shrink-0">
                        <!-- Espace pour boutons supplémentaires -->
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive table-card">
                            @if(session('deleted_message'))
                            <div class="alert {{ session('alert_class') }} alert-dismissible fade show mt-3" role="alert">
                                {{ session('deleted_message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table align-middle table-striped table-hover mb-0" style="font-size: 0.95rem;">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" style="width: 5%;">ID</th>
                                            <th scope="col" style="width: 15%;">Nom</th>
                                            <th scope="col" style="width: 15%;">Prénom</th>
                                            <th scope="col" style="width: 12%;">Email</th>
                                            <th scope="col" style="width: 12%;">Statut</th>
                                            <th scope="col" style="width: 10%;">Photo</th>
                                            <th scope="col" style="width: 16%;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $item)
                                        <tr>
                                            <td><span class="badge bg-primary">#{{$item->id}}</span></td>
                                            <td class="fw-semibold">{{ $item->nom }}</td>
                                            <td>{{ $item->prenom }}</td>
                                            <td>{{ Str::limit($item->email, 20) }}</td>
                                            <td>
                                                @if($item->statut == 'professionnel')
                                                    <span class="badge bg-info text-dark">Professionnel</span>
                                                @elseif($item->statut == 'etudiant')
                                                    <span class="badge bg-primary">Étudiant</span>
                                                @elseif($item->statut == 'enseignant')
                                                    <span class="badge bg-warning text-dark">Enseignant</span>
                                                @elseif($item->statut == 'admin')
                                                    <span class="badge bg-danger">Admin</span>
                                                @else
                                                    <span class="badge bg-secondary">Autre</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->image)
                                                    <a href="{{ asset('images/utilisateurs/'.$item->image) }}" data-lightbox="user-images"
                                                       data-title="{{ $item->nom }}" class="d-block">
                                                        <img src="{{ asset('images/utilisateurs/'.$item->image) }}"
                                                             class="img-thumbnail"
                                                             style="width: 80px; height: 60px; object-fit: cover; cursor: zoom-in;">
                                                    </a>
                                                @else
                                                    <span class="badge bg-secondary">Pas d'image</span>
                                                @endif
                                            </td>
                                            <td>
    <div class="d-flex flex-row gap-2 align-items-center">
        <a href="/update-user/{{$item->id}}" class="btn btn-sm btn-primary px-3 py-1"
           title="Modifier">
            <i class="bi bi-pencil me-1"></i> Modifier
        </a>

        <form action="suppUser/{{ $item->id }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger px-3 py-1"
                    onclick="return confirm('Supprimer \'{{ $item->nom }}\'?')"
                    title="Supprimer">
                <i class="bi bi-trash me-1"></i> Supprimer
            </button>
        </form>

        <form action="{{ url('toggle-user-block/' . $item->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit"
                    class="btn btn-sm {{ $item->bloque ? 'btn-success' : 'btn-warning' }} px-3 py-1"
                    title="{{ $item->bloque ? 'Débloquer' : 'Bloquer' }}">
                <i class="bi {{ $item->bloque ? 'bi-unlock' : 'bi-lock' }} me-1"></i>
                {{ $item->bloque ? 'Débloquer' : 'Bloquer' }}
            </button>
        </form>
    </div>
</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
