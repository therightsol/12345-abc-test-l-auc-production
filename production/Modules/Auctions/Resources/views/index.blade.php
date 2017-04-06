@extends( 'commonbackend::layouts.grid', ['pageTitle' => 'Auctions', 'obj' => $auctions] )

@section('table')
    <table class="table table-striped table-hover dataTable">
        <thead>
        <tr>
            <th>Id</th>
            <th class="sorting" data-table="Car.title">Title</th>
            <th class="sorting" data-table="Auction.bid_starting_amount">Starting Amount</th>
            <th class="sorting" data-table="Auction.average_bid">Average Bid</th>
            <th class="sorting" data-table="Auction.start_date">Start Date</th>
            <th class="sorting" data-table="Auction.end_date">End Date</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        @php($i = $auctions->firstItem())

        @foreach($auctions as $auction)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $auction->title }}</td>
                <td>{{ $auction->bid_starting_amount }}</td>
                <td>{{ $auction->average_bid }}</td>
                <td>{{ $auction->start_date->format('d F Y') }}</td>
                <td>{{ $auction->end_date->format('d F Y') }}</td>
                <td width="150">
                    <a href="{{ route(Helper::route('edit'),$auction->id) }}" type="button" class="btn btn-icon-toggle" data-toggle="tooltip"
                       data-placement="top" data-original-title="Edit row">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" class="btn delete-row btn-icon-toggle"
                            data-id="{{ $auction->id }}" data-toggle="tooltip"
                            data-placement="top" data-original-title="Delete row">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </td>
            </tr>

            @php($i++)

        @endforeach
        </tbody>
    </table>
@endsection



@section('js')
    @parent

    <script>

    </script>
@endsection

@section('style')
    <style>

    </style>


@endsection