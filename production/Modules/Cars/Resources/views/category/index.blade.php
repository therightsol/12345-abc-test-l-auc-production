@extends( 'commonbackend::layouts.grid', ['pageTitle' => 'Car Categories', 'obj' => $categories] )

@section('table')
    <table class="table table-striped table-hover dataTable">
        <thead>
        <tr>
            <th class="sorting" data-table="Category.id">Id</th>
            <th class="sorting" data-table="Category.category">Name</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->category }}</td>
                <td width="150">
                    <a href="{{ route(Helper::route('edit'),$category->id) }}" type="button" class="btn btn-icon-toggle" data-toggle="tooltip"
                       data-placement="top" data-original-title="Edit row">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" class="btn delete-row btn-icon-toggle"
                            data-id="{{ $category->id }}" data-toggle="tooltip"
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