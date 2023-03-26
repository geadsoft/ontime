@extends('layouts.master')
@section('title')
    @lang('translation.orders')
@endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Administrar
        @endslot
        @slot('title')
            Registrar Periodos del Rol
        @endslot
    @endcomponent

    @livewire('vcperiodosrol')

@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/list.js/list.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/list.pagination.js/list.pagination.js.min.js') }}"></script>

    <!--ecommerce-customer init js -->
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/periods-rol.js') }}"></script>

    <script>
       
        window.addEventListener('show-form', event => {
            $('#showModal').modal('show');
        })

        window.addEventListener('hide-form', event => {
            $('#showModal').modal('hide');
        })

        window.addEventListener('show-delete', event => {
            $('#deleteOrder').modal('show');
        })

        window.addEventListener('hide-delete', event => {
            $('#deleteOrder').modal('hide');
        })

        window.addEventListener('msg-grabar', event => {
            swal("¡Grabado!", "Registro ha sido grabado exitosamente!", "success");
        })

        window.addEventListener('get-date', event => {
            
            var dfechaini   = document.getElementById("dfechaini").value;
            var dfechafin   = document.getElementById("dfechafin").value;

            var objDate = {
                fechaini: dfechaini,
                fechafin: dfechafin,
            }

            Livewire.emit('saveData',objDate);

        })

    </script>
    
@endsection
