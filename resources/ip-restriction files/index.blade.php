@extends('layouts.app')

@section('Hero_content')

    @if (!Route::is(['home', 'dashboard']))
        @component('components.hero', [
            'page' => 'IP Restrictions',
            'description' => 'Here you can allow a certain IP address to access the system !',
            ])
        @endcomponent
    @else
        <x-dashboard-hero />
    @endif


@endsection

@push('custom_css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')

    <x-dashboard-cards />
    <x-enter-i-p-adress />
    <x-iprestrictions-data-table />

@endsection


@push('custom_scripts')

    @include('js.routes')
    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- Page JS Helpers (BS Notify Plugin) -->
    <script>
        jQuery(function() {
            One.helpers('notify');
        });
    </script>

    <!-- Page JS Code -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/faisal/ip/main.js') }}"></script>
    <script src="{{ asset('assets/js/ajaxCall.js') }}"></script>
    <script src="{{ asset('assets/js/') }}"></script>
    @include('ThemeInclude.SweetAlerts')
@endpush
