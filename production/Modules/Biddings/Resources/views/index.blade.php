@extends( 'commonbackend::layouts.grid', ['pageTitle' => 'Biddings', 'obj' => $biddings] )

@section('table')
    <table class="table table-striped table-hover dataTable">
        <thead>
        <tr>
            <th>Id</th>
            <th class="sorting" data-table="Bidding.bid_amount">Amount Bid</th>
            <th class="sorting" data-table="Auction.bid_starting_amount">Bid Starting Amount</th>
            <th class="sorting" data-table="UserModel.full_name">User Full Name</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        @php($i = $biddings->firstItem())

        @foreach($biddings as $bid)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $bid->bid_amount }}</td>
                <td>{{ $bid->bid_starting_amount }}</td>
                <td>{{ $bid->full_name }}</td>
                <td width="150">
                    <a href="{{ route(Helper::route('edit'),$bid->id) }}" type="button" class="btn btn-icon-toggle" data-toggle="tooltip"
                       data-placement="top" data-original-title="Edit row">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" class="btn delete-row btn-icon-toggle"
                            data-id="{{ $bid->id }}" data-toggle="tooltip"
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