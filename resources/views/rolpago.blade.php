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
            Nomina
        @endslot
        @slot('title')
            Registrar Roles de Pagos
        @endslot
    @endcomponent

    @livewire('vc-rol-pago')

@endsection
@section('script')
    <!--<script src="{{ URL::asset('assets/libs/list.js/list.js.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/list.pagination.js/list.pagination.js.min.js') }}"></script>-->

    <!--ecommerce-customer init js -->
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

    <script>
        
        window.addEventListener('show-form', event => {
            $('#showModalRubros').modal('show');
        })

        window.addEventListener('hide-form', event => {
            $('#showModalRubros').modal('hide');
        })

        window.addEventListener('show-load', event => {
            $('#loadRecordModal').modal('show');
        })

        window.addEventListener('hide-load', event => {
            $('#loadRecordModal').modal('hide');
        })

    </script>
    
@endsection
