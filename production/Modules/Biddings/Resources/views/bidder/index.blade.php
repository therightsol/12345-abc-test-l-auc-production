@extends('commonbackend::layouts.admin_app')

@section('content')
    <div id="content">
        <section class="">
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-head">
                                <header class="text-primary section-header" style="line-height: 46px; margin-bottom: 0">
                                    My Bidding
                                </header>
                            </div>
                            @php($obj = $biddings)
                            <div class="card-body dataTables_wrapper" style="padding-top: 0;">
                                <form id="filters" action="#">
                                    @include('commonbackend::layouts._table-header')
                                    <table class="table table-striped table-hover dataTable">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th class="sorting" data-table="Bidding.bid_amount">Amount Bid</th>
                                            <th class="sorting" data-table="Auction.bid_starting_amount">Bid Starting Amount</th>
                                            <th class="sorting" data-table="Auction.id">Auction</th>
                                            <th>Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($i = $biddings->firstItem())

                                        @foreach($biddings as $bid)
                                            <tr @if($bid->auction->winner_user_id == \Auth::user()->id) style="    border: 1px solid green;" title="Won" @endif>
                                                <td>{{ $i }}</td>
                                                <td>{{ $bid->bid_amount }}</td>
                                                <td>{{ $bid->bid_starting_amount }}</td>
                                                <td><a href="{{ url(''.$bid->auction_id) }}" target="_blank">{{ $bid->title }}</a></td>
                                                <td width="150">

                                                    <a target="_blank" href="{{ url(''.$bid->auction_id) }}"  class="btn delete-row btn-icon-toggle"
                                                            >
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    {{ $bid->auction->isActive() ? 'Active': 'Closed' }}
                                                </td>
                                            </tr>
                                            @php($i++)
                                        @endforeach
                                        </tbody>
                                    </table>

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
{{--            deleteRow('{{ route(Helper::route('destroy'), '') }}');--}}
        })
    </script>
@endsection
