@extends('layouts.app')


@section('publics')
<script src="{{ asset('js/habilitarInput.js') }}"></script>
<script src="{{ asset('js/registroInsumo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('js/notifCartel.js') }}"></script>
<script src="{{ asset('js/errorCartel.js') }}"></script>

@endsection
@section('content')
@inject('Cliente', 'App\Cliente')
@inject('Insumo', 'App\Insumo')
<div class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" >Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('balanzas.menu')}}" >Balanzas</a></li>
                <li class="breadcrumb-item"><a href="{{route('ingresos.index')}}" >Gestion de ingresos</a></li>
                <li class="breadcrumb-item active">Nuevo ingreso</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{$errors->first()}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
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

            <div class="card">
                <div class="card-header h2">{{ __('Registro de ingreso de insumo') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('ingresos.update')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="cliente" class="col-md-2 col-form-label text-md-right">Cliente</label>

                                <select name="cliente" id="cliente"  class="custom-select col-md-2">
                                    <option data-tokens=="0">Seleccione</option>
                                    @foreach ($clientes as $cli )
                                        <option data-tokens="{{$cli->id}}" value="{{$cli->id}}"> {{$cli->empresa()->first()->denominacion}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <br>
                        <div class="form-group row">
                                <label for="insumo" class="col-md-2 col-form-label text-md-right">Insumo</label>

                                <select name="insumo" id="insumo"  class="selectInsumo custom-select col-md-2">
                                    <option value="0">Seleccione</option>
                                </select>

                                <label for="proveedor" class="col-lg-2 col-form-label text-md-right offset-md-2">Proveedor</label>

                                <select name="proveedor" id="proveedor" class="selectProveedor custom-select col-md-2" >
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{$proveedor->id}}">{{$proveedor->empresa()->first()->denominacion}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <br>

                        <div class="form-group row">
                            <label for="nrolote" class="col-lg-2 col-form-label text-md-right">Nro Lote</label>
                                <input id="nrolote" type="text" class="form-control col-md-2 lotejs" name="nrolote" required>
                                <label for="estrazable" class="col-lg-2 col-form-label text-md-right">es trazable?</label>
                                <input type="checkbox" class="checknrolote mt-md-2" id="chec" name="isInsumoTrazable">
                        </div>

                        <div class="form-group row mt-4">
                            <label for="elaboracion" class="col-lg-2 col-form-label text-md-right">Elaboracion</label>
                            <input id="fechaelaboracion" type="date" class="fechaelaboracion form-control col-md-2 elaboracionjs" name="fechaelaboracion">
                        </div>
                        <div class="form-group row mt-4">
                            <label for="vencimiento" class="col-lg-2 col-form-label text-md-right">Vencimiento</label>
                            <input id="fechavencimiento" type="date" class="fechavencimiento form-control col-md-2 vencimientojs" name="fechavencimiento">
                        </div>

                        <br>
                        <div class="form-group row">
                            <label for="transportista" class="col-md-2 col-form-label text-md-right">Transportista</label>

                            <select name="transportista" id="transportista" class="custom-select col-md-2" data-show-subtext="true" data-live-search="true">
                                @foreach($transportistas as $transportista)
                                    <option value="{{$transportista->id}}">{{$transportista->empresa()->first()->denominacion}}</option>
                                @endforeach
                            </select>

                            <label for="patente" class="col-lg-2 col-form-label text-md-right offset-md-2">Patente</label>
                            <input id="patente" type="text" class="form-control col-md-2 patentejs" name="patente" placeholder="abc123 / ab123ab" required>

                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="nro_cbte" class="col-lg-2 col-form-label text-md-right">NRO Remito/Carta de porte</label>
                                <input id="nro_cbte" type="text" class="form-control col-md-2 cartajs" name="nro_cbte" required>

                        </div>
                        <br>

                        <div class="form-group row">
                            <label for="pesaje" class="col-lg-2 col-form-label text-md-right">Peso vehiculo</label>
                                <input id="pesaje" type="text" class="pesajes form-control col-md-2 pesojs" placeholder="peso bruto" name="pesaje" readonly required>
                                <span class="ml-2 mt-2">kg</span>

                            <label class="pesajeAleatorio btn btn-success btn-block col-sm-2 offset-1" >leer pesaje</label>
                        </div>
                        <br>
                        <div class="form-inline row">
                            <a class="btn btn-secondary col-sm-3" href="{{route('ingresos.index')}}">Cancelar</a>
                            <button type="submit"  class="btn btn-primary col-sm-3 offset-md-6">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
