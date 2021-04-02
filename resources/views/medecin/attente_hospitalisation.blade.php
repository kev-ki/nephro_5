@extends('layouts.medlayout')

@section('content')
    <h1 class="text-center" style="background-color: #01A9CB; height: 30px; font-size: large; padding-top: 5px; font-weight: bold">Patients en Attente d'Hospitalisation</h1>
    <div class="container-fluid p-1" style="background-color: white">
        <div class="flash-message col-12">
            @if(Session::has('message'))
                <div class="alert {{Session::get('alert-class')}}">
                    {{session::get('message')}}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
            @endif
        </div>

        <div class="card p-2">
            <div class="card-header">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-5 d-flex justify-content-start">
                                {{--<button class="btn btn-outline-primary mr-1 mb-sm-1-1">
                                    <a href="{{route('hospitalisation.create')}}">Hospitaliser
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                        </svg>
                                    </a>
                                </button>--}}
                            </div>
                            <form method="POST" class="col-md-7" action="{{route('hospi.search')}}">
                                @csrf
                                <div class="col-md d-flex justify-content-end">
                                    <select id="option" type="text" onchange="hospisearch(this)" class="col-md-2 selectpicker form-control @error('option') is-invalid @enderror" name="option" data-placeholder="Choisir" data-style="btn-outline-secondary">
                                        <option value="id">ID</option>
                                        <option value="date_entree">Date entrée</option>
                                        <option value="date_sortie">Date sortie</option>
                                        <option value="numerochambre">Num chambre</option>
                                    </select>
                                    @error('option')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror

                                    <input id="rechercher" type="text" class="col-md-6 form-control-perso  @error('rechercher') is-invalid @enderror" placeholder="Mot clé..." name="rechercher">
                                    @error('rechercher')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror

                                    <div class="col-md-2">
                                        <button type="submit" name="search" class="btn btn-outline-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="25" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                                <title>rechercher</title>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body embed-responsive">
                <div class="table-responsive">
                    <ul>
                        <table class="table">
                            <thead class="font-weight-bold">
                            <tr>
                                <th scope="col">ID Patient</th>
                                <th scope="col">Nom Patient</th>
                                <th scope="col">Prénom Patient</th>
                                <th scope="col">Date Entrée</th>
                                <th scope="col">Date Sortie</th>
                                <th scope="col">Chambre</th>
                                <th scope="col">Lit</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($patients_hospi as $hospi)
                                <tr>
                                    <td class="font-weight-bold">{{$hospi->id_patient}}</td>
                                    <td>
                                        @foreach($patients as $value)
                                            @if($hospi -> id_patient == $value->idpatient)
                                                {{$value->nom}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($patients as $value)
                                            @if($hospi -> id_patient == $value->idpatient)
                                                {{$value->prenom}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $hospi->date_entree }}</td>
                                    <td>{{ $hospi->date_sortie }}</td>
                                    <td>{{ $hospi->numerochambre }}</td>
                                    <td>{{ $hospi->numerolit }}</td>

                                    <td>
                                        <a href="{{route('hospitalisation.edit',$hospi->id)}}" class="btn-sm btn-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                <title>éditer</title>
                                            </svg>
                                        </a>
                                    </td>
                            @endforeach
                            </tbody>
                        </table>
                    </ul>
                    <div class="d-flex justify-content-center">
                        {{$patients_hospi-> links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
