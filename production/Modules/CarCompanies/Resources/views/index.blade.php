@extends( 'commonbackend::layouts.grid', ['pageTitle' => 'Car Companies', 'obj' => $carCompanies] )

@section('table')
    <table class="table table-striped table-hover dataTable">
        <thead>
        <tr>
            <th>Id</th>
            <th class="sorting" data-table="CarCompaniesModel.company_name">Company Name</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        @php($i = $carCompanies->firstItem())

        @foreach($carCompanies as $carCompany)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $carCompany->company_name }}</td>
                <td width="150">
                    <a href="{{ route(Helper::route('edit'),$carCompany->id) }}" type="button" class="btn btn-icon-toggle" data-toggle="tooltip"
                       data-placement="top" data-original-title="Edit row">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" class="btn delete-row btn-icon-toggle"
                            data-id="{{ $carCompany->id }}" data-toggle="tooltip"
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