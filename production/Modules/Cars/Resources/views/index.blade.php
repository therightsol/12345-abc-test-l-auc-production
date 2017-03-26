@extends( 'commonbackend::layouts.grid', ['pageTitle' => 'Cars', 'obj' => $cars] )

@section('table')
    <table class="table table-striped table-hover dataTable">
        <thead>
        <tr>
            <th class="sorting" data-table="Car.id">Id</th>
            <th class="sorting" data-table="Car.title">Title</th>
            <th class="sorting" data-table="Car.grade">Grade</th>
            <th class="sorting" data-table="CarModel.model_name">Model</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        @foreach($cars as $car)
            <tr>
                <td>{{ $car->id }}</td>
                <td>{{ $car->title }}</td>
                <td>{{ $car->grade }}</td>
                <td>{{ $car->model_name }}</td>
                <td width="150">
                    <a href="{{ route(Helper::route('edit'),$car->id) }}" type="button" class="btn btn-icon-toggle" data-toggle="tooltip"
                       data-placement="top" data-original-title="Edit row">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" class="btn delete-row btn-icon-toggle"
                            data-id="{{ $car->id }}" data-toggle="tooltip"
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