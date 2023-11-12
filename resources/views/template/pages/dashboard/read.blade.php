@extends('template.layout.main')

@section('container')
    <div class="app-main">
        <div id="kt_app_content" class="app-content  flex-column-fluid ">
            <div id="kt_app_content_container" class="app-container  container-fluid ">
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{ asset('assets/js/highcart/highcharts.js') }}"></script>
        <script src="{{ asset('assets/js/highcart/variable-pie.js') }}"></script>
        <script src="{{ asset('assets/js/highcart/exporting.js') }}"></script>
        <script src="{{ asset('assets/js/highcart/export-data.js') }}"></script>
        <script src="{{ asset('assets/js/highcart/accessibility.js') }}"></script>
        <script></script>
    @endpush
@endsection
