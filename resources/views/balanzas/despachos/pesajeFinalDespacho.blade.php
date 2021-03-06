@extends('layouts.app')
@section('publics')
    <script src="{{ asset('js/pesajeFinalDespacho.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
@endsection

@section('content')
    <div class="container">
        <div class="bs-example">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('balanzas.menu')}}">Balanzas</a></li>
                    <li class="breadcrumb-item"><a href="{{route('despachos.index')}}">Gestion de despacho</a></li>
                    <li class="breadcrumb-item active">Finalizar despacho</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="form-group row d-flex justify-content-center">

        @if (session('error'))
            <div class="">
                <p class="errorjs" style="display:none">{{ session('error') }}</p>
            </div>
        @endif

        @if (session('mensaje'))
            <div class="" role="alert">
                <p class="alertajs" style="display:none">{{ session('mensaje') }}</p>
            </div>
        @endif
        <div class="col-md-7">
            @if ($errors->any())
                <div class="alert alert-danger">
                    {{$errors->first()}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">

                <div class="card-header text-center h2">
                    {{__('Pesaje final de despacho')}}
                </div>

                <div class="card-body">

                    <form action="{{route('despachos.finalize.post')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="patente" class="col-md-2 col-form-label text-md-right">Patente</label>
                            <input id="patente" type="text" class="form-control col-md-2" placeholder="patente"
                                   name="patente" value="{{$ticketSalida->patente}}" readonly>
                        </div>

                        <div class="form-group row mt-5">
                            <label for="cliente" class="col-md-2 col-form-label text-md-right">Cliente</label>
                            <input id="cliente" type="text" class="form-control col-md-6" placeholder="" name="cliente"
                                   value="{{$ticketSalida->cliente}}" readonly>

                        </div>

                        <div class="form-group row mt-2">
                            <label for="producto" class="col-md-2 col-form-label text-md-right">Producto</label>
                            <input id="producto" type="text" class="form-control col-md-5" placeholder=""
                                   name="producto" value="{{$ticketSalida->producto}}" readonly>

                            <label for="nro orden" class="col-sm-2 col-form-label text-md-right">Nro. orden</label>
                            <input id="nroorden" type="text" class="form-control col-md-1" placeholder=""
                                   name="nroorden" value="{{$ticketSalida->op_id}}" readonly>
                        </div>

                        <div class="form-group row mt-5">
                            <label for="transportista"
                                   class="col-sm-2 col-form-label text-right">Transportista</label>
                            <input id="transportista" type="text" class="form-control col-md-5" placeholder=""
                                   name="transportista" value="{{$ticketSalida->transporte}}" readonly>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="pesovehiculo" class="col-md-2 col-form-label text-md-right">Peso vehiculo (tara)</label>
                            <input id="peso" type="text" class="form-control col-md-2" placeholder="" name="peso"
                                   value="{{$ticketSalida->tara}}" readonly>
                            <span class="ml-2 mt-2">kgs</span>
                        </div>

                        <div class="form-inline row mt-3">
                            <label for="pesovcargado" class="col-md-2 col-form-label text-md-right">Peso vehículo
                                cargado</label>
                            <input id="pesocargado" type="text" class="form-control col-md-1 pesocargado" placeholder=""
                                   name="pesocargado">
                            <span class="ml-2 mt-2">kgs</span>
                            <label class="pesajeAleatorio btn btn-outline-success btn-block col-md-2 offset-md-1">Leer
                                pesaje</label>
                        </div>

                        <div class="form-inline row mt-5">
                            <a href="{{back()}}" class="btn btn-secondary col-sm-2">Cancelar</a>
                            <button class="btn btn-primary col-sm-2 offset-md-8">Finalizar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
