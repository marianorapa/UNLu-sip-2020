@extends('layouts.app')
@section('publics')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
@endsection

@section('content')
    <section class="container">
        <section>
            <div class="bs-example">
                <nav>
                    <ol class="breadcrumb">

                    </ol>
                </nav>
            </div>

            <div class="col-md-10">
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
            </div>
            <div class="row justify-content-center mt-4">
                <a class="btn btn-primary btn m-1 col-3" href="{{route('producto.create')}}">Nuevo Producto</a>
            </div>
            <div class="row justify-content-center mt-4 border-top border-bottom py-3">
                <form class="form-inline">
                    <input name="cliente" class="form-control mr-sm-2 clientejs" type="search" placeholder="Empresa" aria-label="buscar por Cliente">
                    <input name="alimento" class="form-control mr-sm-2 productojs" type="search" placeholder="Alimento" aria-label="buscar por Alimento">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </div>

        </section>

        <section>
            <table class="table mt-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{$errors->first()}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Gtin</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($alimentos as $alimento)
                        <tr>
                            <th scope="row">{{$alimento->id}}</th>
                            <td>{{$alimento->descripcion}}</td>
                            <td>{{$alimento->alimentoTipo()->first()->descripcion}}</td>
                            <td>{{$alimento->cliente()->first()->empresa()->first()->denominacion}}</td>
                            @if(empty($alimento->gtin))
                                <td>no posee</td>
                            @else
                                <td>{{$alimento->gtin}}</td>
                            @endif


                        </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="row justify-content-center">

            </div>
        </section>
        <a class="btn btn-secondary btn-sm" href="{{route('administracion.menu')}}">Volver</a>
    </section>

@endsection
