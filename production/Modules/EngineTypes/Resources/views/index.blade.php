@extends( 'commonbackend::layouts.grid', ['pageTitle' => 'Engine Types', 'obj' => $engineTypes] )

@section('table')
    <table class="table table-striped table-hover dataTable">
        <thead>
        <tr>
            <th class="sorting" data-table="EngineType.id">Id</th>
            <th class="sorting" data-table="EngineType.title">Name</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        @php($i = $engineTypes->firstItem())

        @foreach($engineTypes as $engineType)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $engineType->title }}</td>
                <td width="150">
                    <a href="{{ route(Helper::route('edit'),$engineType->id) }}" type="button" class="btn btn-icon-toggle" data-toggle="tooltip"
                       data-placement="top" data-original-title="Edit row">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" class="btn delete-row btn-icon-toggle"
                            data-id="{{ $engineType->id }}" data-toggle="tooltip"
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