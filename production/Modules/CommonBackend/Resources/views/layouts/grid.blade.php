@extends('commonbackend::layouts.admin_app')

@section('content')
    <div id="content">
        <section class="">
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-head">
                                @include('commonbackend::layouts._section-head')
                            </div>
                            <div class="card-body dataTables_wrapper" style="padding-top: 0;">
                                <form id="filters" action="#">
                                    @include('commonbackend::layouts._table-header')
                                    @yield('table')
                                </form>
                            </div><!--end .card-body -->
                            @include('commonbackend::layouts._table-footer')

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('commonbackend::layouts.confirm-modal')

@endsection
@section('js')
    <script src="{{ Module::asset('commonbackend:admin_assets/js/includes/h-functions.js') }}"></script>
    <script>

        $(document).ready(function () {
            $('table.dataTable').setTableOrder({
                form: 'form#filters'
            });
            deleteRow('{{ route(Helper::route('destroy'), '') }}');
        })
    </script>
@endsection