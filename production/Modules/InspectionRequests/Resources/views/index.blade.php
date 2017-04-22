@extends( 'commonbackend::layouts.grid', ['pageTitle' => 'Auctions', 'obj' => $inspections] )

@section('table')
    <table class="table table-striped table-hover dataTable">
        <thead>
        <tr>
            <th>Id</th>
            <th class="sorting" data-table="UserModel.username">Username</th>
            <th class="sorting" data-table="InspectionRequest.date_of_inspection">Date of inspection</th>
            <th >Time of inspection</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        @php($i = $inspections->firstItem())

        @foreach($inspections as $inspection)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $inspection->username }}</td>
                <td>{{ $inspection->date_of_inspection->format('d F Y') }}</td>
                <td>{{ $inspection->time_of_inspection }}</td>
                <td width="150">
                    <a href="{{ route(Helper::route('edit'),$inspection->id) }}" type="button" class="btn btn-icon-toggle" data-toggle="tooltip"
                       data-placement="top" data-original-title="Edit row">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" class="btn delete-row btn-icon-toggle"
                            data-id="{{ $inspection->id }}" data-toggle="tooltip"
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