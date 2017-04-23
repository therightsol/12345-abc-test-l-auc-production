@extends( 'commonbackend::layouts.grid', ['pageTitle' => 'Car Feature', 'obj' => $features] )

@section('table')
    <table class="table table-striped table-hover dataTable">
        <thead>
        <tr>
            <th>Id</th>
            <th class="sorting" data-table="feature.title">Title</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @php($i = $features->firstItem())

        @foreach($features as $feature)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $feature->title }}</td>
                <td width="150">
                    <a href="{{ route(Helper::route('edit'),$feature->id) }}" type="button" class="btn btn-icon-toggle" data-toggle="tooltip"
                       data-placement="top" data-original-title="Edit row">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" class="btn delete-row btn-icon-toggle"
                            data-id="{{ $feature->id }}" data-toggle="tooltip"
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