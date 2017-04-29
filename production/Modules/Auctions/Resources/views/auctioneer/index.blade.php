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
                                    My Auctions
                                </header>
                            </div>
                            @php($obj = $auctions)
                            <div class="card-body dataTables_wrapper" style="padding-top: 0;">
                                <form id="filters" action="#">
                                    @include('commonbackend::layouts._table-header')
                                    <table class="table table-striped table-hover dataTable">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th class="sorting" data-table="Car.title">Title</th>
                                            <th class="sorting" data-table="Auction.bid_starting_amount">Bidding Starting Amount</th>
                                            <th>Total Bids</th>
                                            <th>Status</th>
                                            <th>view All Bids</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($i = $auctions->firstItem())

                                        @foreach($auctions as $auction)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td><a href="{{ url(''.$auction->id) }}">{{ $auction->title }}</a></td>
                                                <td>{{ $auction->bid_starting_amount }}</td>
                                                <td>{{ $auction->bidding->count() }}</td>
                                                <td>{{ ($auction->winner_user_id)? 'Closed': 'Opened' }}</td>
                                                <td width="150">
                                                    <a  href="{{ route('auctioneer.auctionBids', ['id' => $auction->id]) }}"  class="btn btn-icon-toggle">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
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
