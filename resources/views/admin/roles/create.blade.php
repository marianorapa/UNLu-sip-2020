@extends('layouts.app')
@section('publics')
    <script src="{{ asset('js/rolescreate.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/notifCartel.js') }}"></script>
    <script src="{{ asset('js/errorCartel.js') }}"></script>
@endsection
@section('content')

<section class="container">
    <div class="bs-example">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" >Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.menu')}}" >Admin</a></li>
                <li class="breadcrumb-item"><a href="{{route('roles.index')}}" >Gestion de roles</a></li>
                <li class="breadcrumb-item active">Agregar rol</li>
            </ol>
        </nav>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('error'))
            <div class="" role="alert">
                <p class="errorjs" style="display:none">{{ session('error') }}</p>
            </div>
            @endif
            <div class="card">
                <div class="card-header text-center h2">{{ __('Registro de roles') }}</div>
                    <div class="card-body">
                        <form action="{{route('roles.store')}}" method="POST">
                            @csrf
                            @error('name')
                            <div class="alert alert-danger">
                                El nombre es obligatorio!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @enderror

                            @error('descr')
                                <div class="alert alert-danger">
                                    La descripcion es obligatoria!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @enderror

                            @if (session('mensaje'))
                            <div class="" role="alert">
                                <p class="alertajs" style="display:none">{{ session('mensaje') }}</p>
                            </div>
                            @endif

                            <div class="form-group row">
                                <label for="name"class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>


                                <div class="col-md-6">
                                    <input type="text" name="name" id="name"
                                    value="{{old('username')}}" placeholder="Nombre"
                                    class="usernamejs form-control mb-2" required>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="descr" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                                <div class="col-md-6 ">
                                    <input type="text" name="descr" id="descr"
                                    value="{{old('descripcion')}}"
                                    placeholder="Descripcion" class="observacionjs form-control mb-2" required>
                                </div>
                            </div>



{{--                            <div class="form-group row mx-2 ">--}}
{{--                           --}}{{-- @foreach ($permisos as $permiso)--}}
{{--                                <div class="form-check col-md-8">--}}
{{--                                    <input type="checkbox" class="form-check-input" name="{{$permiso->name}}" id="{{$permiso->name}}">--}}
{{--                                    <label for="{{$permiso->name}}" class="form-check-label text-capitalize mb-3">{{$permiso->name}}</label>--}}
{{--                                </div>--}}
{{--                           @endforeach   --}}


{{--                           <select name="idPermisos[]" id="permiso" class="form-control" size="10" required multiple>--}}
{{--                            @foreach ($permisos as $permiso)--}}
{{--                                <option value="{{$permiso->id}}">{{"$permiso->nombre_ruta"}}</option>--}}
{{--                            @endforeach--}}
{{--                            </select>--}}

{{--                           </div>--}}


                            <script>

                                function toggleCheckboxes() {
                                    let list = document.getElementsByClassName( "checkboxPermiso");
                                    let newValue = (document.getElementById("selectAllCheckbox")).checked;
                                    for (let item of list) {
                                        item.checked = newValue;
                                    }
                                }

                            </script>

                            <label class="col-md-11">Seleccione los permisos del rol:</label>
                            <input type="checkbox" class="" id="selectAllCheckbox" onchange="toggleCheckboxes()">

                            <div class="form-group row mx-5 ">

                            <table class="table table-striped">
                               <thead>
                                   <tr>
                                       <th scope="col">#</th>
                                       <th scope="col">Permiso</th>
                                       <th scope="col">Descripción</th>
                                       <th scope="col">Seleccionar</th>
                                   </tr>
                               </thead>
                                <tbody>
                                    @foreach ($permisos as $permiso)
                                   <tr>
                                       <td>{{$permiso->id}}</td>
                                       <td>{{$permiso->nombre_ruta}}</td>
                                       <td>{{$permiso->descr}}</td>
                                       <td class="text-center">
                                           <input type="checkbox" name="idPermisos[]" class="checkboxPermiso" value="{{$permiso->id}}">
                                       </td>
                                   </tr>
                                @endforeach
                                </tbody>
                            </table>

                            </div>

                            {{-- <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">

                                </div>
                            </div> --}}
                            <button type="submit" class="btn btn-primary btn-block mt-3">
                                {{ __('Registrar') }}
                            </button>
                                <a class="btn btn-secondary btn-block mt-3" href="{{route('roles.index')}}">Volver</a>
                        </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
