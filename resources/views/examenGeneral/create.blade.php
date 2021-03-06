@extends('layouts.medlayout')

@section('content')
    <h1 class="text-center" style="background-color: #01A9CB; height: 30px; font-size: large; padding-top: 5px; font-weight: bold">Examen Clinique</h1>
    <div class="container-fluid p-2" style="background-color: white">
        <div class="flash-message col-md-12">
            @if(Session::has('message'))
                <div class="alert {{Session::get('alert-class')}}">
                    {{session::get('message')}}<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
            @endif
        </div>
        <div class="card p-2">
            <div class="card-header text-center font-weight-bold text-uppercase">Examen General</div>
            <div class="card-body">
                <form action="{{route('examen-general.store')}}" method="post">
                    @csrf
                    <div class="col">
                        <div class="form-group row d-flex justify-content-end">
                            <input type="text" name="taille" placeholder="Taille" class="col-sm-1 form-control" value="{{old('taille') ?? $constante->taille}}"><span class="text-center disabled btn btn-outline-secondary">Cm</span>
                            <input type="text" name="poids" placeholder="Poids" class="col-sm-1 form-control" value="{{old('poids') ?? $constante->poids}}"><span class="text-center disabled btn btn-outline-secondary">Kg</span>
                            <input type="text" name="sc" placeholder="SC" class="col-sm-1 form-control" value="{{old('sc') ?? $constante->saturation_oxygene}}"><span class="text-center disabled btn btn-outline-secondary"></span>
                            <input type="text" name="ta" placeholder="TA" class="col-sm-1 form-control" value="{{old('ta') ?? $constante->frequence_cardiaque}}"><span class="text-center disabled btn btn-outline-secondary"></span>
                            <input type="text" name="pouls" placeholder="Pouls" class="col-sm-1 form-control" value="{{old('pouls') ?? $constante->pouls}}"><span class="text-center disabled btn btn-outline-secondary"></span>
                            <input type="text" name="temperature" placeholder="Temp??rature" class="col-sm-1 form-control" value="{{old('temperature') ?? $constante->temperature}}"><span class="text-center disabled btn btn-outline-secondary">??C</span>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group row">
                            <label class="text-right col-md-2 font-weight-bold">Etat g??n??ral<em style="color: red;">*</em> :</label>
                            <select class="selectpicker form-control col-md-10" onchange="examGeneralAmai(this)" data-placeholder="Choisir" multiple data-style="btn-outline-secondary" name="etatgeneral[]">
                                <option value="bon">Bon</option>
                                <option value="moyen">Moyen</option>
                                <option value="mauvais">Mauvais</option>
                                <option value="anorexie ">Anorexie </option>
                                <option value="asthenie">Asth??nie</option>
                                <option value="amaigrissement">Amaigrissement</option>
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group row" id="amaigrissement" style="display: none">
                            <label class="text-right col-md-2 font-weight-bold">Estimer la perte de poids<em style="color: red;">*</em> :</label>
                            <input type="text" name="pertepoid" class="col-md-4 form-control">
                            <label class="text-right col-md-2 font-weight-bold">Estimer la dur??e<em style="color: red;">*</em> :</label>
                            <input type="text" name="duree_amaigrissement" class="col-md-4 form-control">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group row">
                            <label class="text-right col-md-2 font-weight-bold">Conjonctives<em style="color: red;">*</em> :</label>
                            <select class="selectpicker form-control col-md-4" name="conjonctive[]" data-placeholder="Choisir" data-style="btn-outline-secondary"  multiple>
                                <option value="bien coloree">Bien color??es</option>
                                <option value="moyennement coloree">Moyennement color??es</option>
                                <option value="pale">P??les</option>
                                <option value="icterique">Ict??rique</option>
                            </select>
                            <label class="text-right col-md-2 font-weight-bold">Langue<em style="color: red;">*</em> :</label>
                            <select class="selectpicker form-control col-md-4"  data-placeholder="Choisir" data-style="btn-outline-secondary" multiple onchange="examGeneralAutre(this)" name="etat_langue[]">
                                <option value="propre">Propre </option>
                                <option value="saburrale">Saburrale </option>
                                <option value="garde empreinte des dents">Garde l???empreinte des dents</option>
                                <option value="autre">Autres l??sions</option>
                            </select>
                        </div>
                    </div>

                    <div class="col" id="lesion_langue" style="display: none">
                        <div class="form-group row">
                            <label class="text-right col-md-2 font-weight-bold">Autres l??sions<em style="color: red;">*</em> :</label>
                            <input type="text" name="lesion_langue"  class="col-md-10 form-control">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group row">
                            <label class="text-right col-md-2 font-weight-bold">??d??mes :</label>
                            <select class="selectpicker form-control col-md-4" data-placeholder="Choisir" data-style="btn-outline-secondary" name="oeudeme[]" multiple>
                                <option value="mou">Mous</option>
                                <option value="dur">Durs</option>
                                <option value="bilateral">Bilat??raux </option>
                                <option value="godet">Godet </option>
                                <option value="blanc">Blancs </option>
                                <option value="colore">Color??s </option>
                            </select>
                            <label class="text-right font-weight-bold col-md-2">Si??ge ??d??mes :</label>
                            <select class="selectpicker form-control col-md-4" data-placeholder="Choisir" data-style="btn-outline-secondary" name="siege[]" multiple>
                                <option value="visage">Visage </option>
                                <option value="paupiere">Paupi??res </option>
                                <option value="MI">Membres Inf??rieurs</option>
                                <option value="MS">Membres Sup??rieurs</option>
                                <option value="ascite">Ascite </option>
                                <option value="general">G??n??ralis??s</option>
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group row">
                            <label class="text-right font-weight-bold col-md-2">D??shydratation<em style="color: red;">*</em> :</label>
                            <select class="selectpicker form-control col-md-4" data-placeholder="Choisir" data-style="btn-outline-secondary" name="deshydratation">
                                <option value="extracellulaire">Extracellulaire</option>
                                <option value="intracellulaire">Intracellulaire</option>
                                <option value="globale">Globale</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mr-1">Enregistrer</button>
                        <div class="btn btn-secondary"><a style="color: white" href="{{route('examen-appareil.create')}}">Suivant</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
