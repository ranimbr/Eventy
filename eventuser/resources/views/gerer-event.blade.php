@extends('theme1')
@section('contenu')
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Gérer mes évènements</h4>



                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <!-- end row -->

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Liste des evenements</h4>

                                    <div class="flex-shrink-0">

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
<div class="card-body">
    <div class="table-responsive">
        <table class="table align-middle table-striped table-hover mb-0" style="font-size: 0.95rem;">
            <thead class="table-light">
                <tr>
                    <th scope="col" style="width: 5%;">ID</th>
                    <th scope="col" style="width: 15%;">Titre</th>
                    <th scope="col" style="width: 10%;">Catégorie</th>
                    <th scope="col" style="width: 12%;">Location</th>
                    <th scope="col" style="width: 12%;">Date début</th>
                    <th scope="col" style="width: 12%;">Date fin</th>
                    <th scope="col" style="width: 18%;">Description</th>
                    <th scope="col" style="width: 18%;">Crée par </th>
                    <th scope="col" style="width: 10%;">Affiche</th>
                    <th scope="col" style="width: 16%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td><span class="badge bg-primary">#{{$item->id}}</span></td>
                    <td class="fw-semibold">{{ Str::limit($item->titre, 20) }}</td>
                    <td><span class="badge bg-info text-dark">{{ $item->categorie }}</span></td>
                    <td>{{ Str::limit($item->location, 15) }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->date_debut)->format('d/m/Y H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->date_fin)->format('d/m/Y H:i') }}</td>
                    <td>
                        <span class="d-inline-block text-truncate" style="max-width: 200px;"
                              title="{{ $item->description }}">
                            {{ $item->description }}
                        </span>
                    </td>
                    <td>{{ Str::limit($item->Cree_par, 15) }}</td>
                    <td>
                        @if($item->image)
                        <a href="{{ asset('images/events/'.$item->image) }}" data-lightbox="event-images"
                           data-title="{{ $item->titre }}" class="d-block">
                            <img src="{{ asset('images/events/'.$item->image) }}"
                                 class="img-thumbnail"
                                 style="width: 80px; height: 60px; object-fit: cover; cursor: zoom-in;">
                        </a>
                        @else
                        <span class="badge bg-secondary">Pas d'image</span>
                        @endif
                    </td>
                    <td>
                    <div class="d-flex flex-row gap-2 align-items-center">
                            <a href="/update-event/{{$item->id}}" class="btn btn-sm btn-primary px-3 py-1"
                               title="Modifier">
                                <i class="bi bi-pencil me-1"></i> Modifier
                            </a>
                            <form action="suppEvent/{{$item->id}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger px-3 py-1"
                                        onclick="return confirm('Supprimer \'{{ $item->titre }}\'?')"
                                        title="Supprimer">
                                    <i class="bi bi-trash me-1"></i> Supprimer
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
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div>
@endsection('contenu')




