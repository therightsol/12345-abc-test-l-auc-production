@extends( 'commonbackend::layouts.grid', ['pageTitle' => 'Car Models', 'obj' => $carModels] )

@section('table')
    <table class="table table-striped table-hover dataTable">
        <thead>
        <tr>
            <th class="sorting" data-table="CarModel.id">Id</th>
            <th class="sorting" data-table="CarModel.company_name">Model Name</th>
            <th class="sorting" data-table="CarCompany.company_name">Company Name</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        @foreach($carModels as $carModel)
            <tr>
                <td>{{ $carModel->id }}</td>
                <td>{{ $carModel->model_name }}</td>
                <td>{{ $carModel->company_name }}</td>
                <td width="150">
                    <a href="{{ route(Helper::route('edit'),$carModel->id) }}" type="button" class="btn btn-icon-toggle" data-toggle="tooltip"
                       data-placement="top" data-original-title="Edit row">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" class="btn delete-row btn-icon-toggle"
                            data-id="{{ $carModel->id }}" data-toggle="tooltip"
                            data-placement="top" data-original-title="Delete row">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </td>
            </tr>

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