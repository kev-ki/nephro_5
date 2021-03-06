@extends('layouts.medlayout')

@section('content')
    <h1 class="text-center" style="background-color: #01A9CB; height: 30px; font-size: large; padding-top: 5px; font-weight: bold">Constante de {{$patient->prenom}} {{$patient->nom}} [ ID : {{$patient->idpatient}} ]</h1>
    <div class="container-fluid p-2" style="background-color: white">
        <div class="card bg-white mb-2" style=" box-shadow: 0 0 5px whitesmoke;">
            <div class="col-12">
                <div class="row p-1">
                    <div class="col-6">
                        <div class="row form-group">
                            <label class="font-weight-bold col-5 text-right">Poids:</label>
                            <input type="text" readonly class="form-control col-7" value="{{$constante->poids}} kg">
                        </div>
                        <div class="row form-group">
                            <label class="font-weight-bold col-5 text-right">Taille:</label>
                            <input type="text" readonly class="form-control col-7" value="{{$constante->taille}} m">
                        </div>
                        <div class="row form-group">
                            <label class="font-weight-bold col-5 text-right">Tension:</label>
                            <input type="text" readonly class="form-control col-7" value="{{$constante->tension}}">
                        </div>
                        <div class="row form-group">
                            <label class="font-weight-bold col-5 text-right">Frequence Cardiaque:</label>
                            <input type="text" readonly class="form-control col-7" value="{{$constante->frequence_cardiaque}}">
                        </div>
                        <div class="row form-group">
                            <label class="font-weight-bold text-right col-5">Pouls:</label>
                            <input type="text" readonly class="form-control col-7" value="{{$constante->pouls}}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row form-group">
                            <label class="font-weight-bold text-right col-5">Temperature:</label>
                            <input type="text" readonly class="form-control col-7" value="{{$constante->temperature}}">
                        </div>
                        <div class="row form-group">
                            <label class="font-weight-bold col-5 text-right">Status:</label>
                            <input type="text" readonly class="form-control col-7" value="{{$constante->status}}">
                        </div>
                        <div class="row form-group">
                            <label class="font-weight-bold col-5 text-right">Saturation en Oxygene:</label>
                            <input type="text" readonly class="form-control col-7" value="{{$constante->saturation_oxygene}}">
                        </div>
                        <div class="row form-group">
                            <label class="font-weight-bold col-5 text-right">Frequence Respiratoire:</label>
                            <input type="text" readonly class="form-control col-7" value="{{$constante->frequence_respiratoire}}">
                        </div>
                        <div class="row form-group">
                            <label class="font-weight-bold text-right col-5">Date de prise:</label>
                            <input type="text" readonly class="form-control  col-7" value="{{$constante->dateprise}}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center p-2 mb-2">
                <button class="btn-sm btn-secondary mr-1"><a style="color: #2d2d2d" href="{{route('medecin.constante_edit', $constante->id)}}">edit</a></button>
                <button class="btn-sm btn-primary"><a style="color: #fff" href="#">imprimer</a></button>
            </div>
        </div>
    </div>
@endsection
