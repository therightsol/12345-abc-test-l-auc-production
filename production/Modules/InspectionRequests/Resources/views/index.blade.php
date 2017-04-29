@extends( 'commonbackend::layouts.grid', ['pageTitle' => 'Inspections', 'obj' => $inspections] )

@section('table')
    <table class="table table-striped table-hover dataTable">
        <thead>
        <tr>
            <th>Id</th>
            <th class="sorting" data-table="UserModel.username">Username</th>
            <th>Car Title</th>
            <th class="sorting" data-table="InspectionRequest.date_of_inspection">Date of inspection</th>
            <th>Time of inspection</th>
            <th>Action/Status</th>

        </tr>
        </thead>
        <tbody>
        @php($i = $inspections->firstItem())

        @foreach($inspections as $inspection)
            <tr>
                <td>{{ $inspection_unique_id.$inspection->id }}</td>
                <td>{{ $inspection->username }}</td>
                <td>{{ $inspection->title }}</td>
                <td>{{ $inspection->date_of_inspection->format('d F Y') }}</td>
                <td>{{ $inspection->time_of_inspection }}</td>
                <td width="150">
                    @if(\Auth::user()->hasRole(['auctioneer']) and ($inspection->date_of_inspection->format('Y-m-d') . ' '. $inspection->time_of_inspection > \Carbon\Carbon::now()->addDay()) )
                    <a href="{{ route(Helper::route('edit'),$inspection->id) }}" type="button"
                       class="btn btn-icon-toggle" data-toggle="tooltip"
                       data-placement="top" data-original-title="Edit row">
                        <i class="fa fa-pencil"></i>
                    </a>
                        @else

                        @if(!$inspection->is_inspection_complete)
                        Time up (Pending)
                            @else
                            Complete
                            @endif
                            <br>

                    @endif
                    @if(\Auth::user()->hasRole(['admin', 'staff']) )
                    <a href="{{ route(Helper::route('edit'),$inspection->id) }}" type="button"
                       class="btn btn-icon-toggle" data-toggle="tooltip"
                       data-placement="top" data-original-title="Edit row">
                        <i class="fa fa-pencil"></i>
                    </a>
                    @endif
                    @if(!\Auth::user()->hasRole(['auctioneer']))
                        <button type="button" class="btn delete-row btn-icon-toggle"
                                data-id="{{ $inspection->id }}" data-toggle="tooltip"
                                data-placement="top" data-original-title="Delete row">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    @endif
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