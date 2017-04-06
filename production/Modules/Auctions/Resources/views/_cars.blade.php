
<div class="col-md-12">
    <div class="card">
        <div class="card-head">
            <header class="text-primary section-header" style="line-height: 46px; margin-bottom: 0">
                Select Car
            </header>
        </div>
        <div class="card-body dataTables_wrapper" style="padding-top: 0;">
            <form id="filters" action="#">
                <div class="row form" style="display: flex; align-items: center">
                    <div class="col-sm-9">
                        <div class="dataTables_length no-margin" id="country_table_length">
                            <label>
                                <select id="filter-limit-select"
                                        name="limit" aria-controls="country_table" class="">
                                    <option value="10" @if($cars->perPage() == 10) selected @endif >10</option>
                                    <option value="25" @if($cars->perPage() == 25) selected @endif>25</option>
                                    <option value="50" @if($cars->perPage() == 50) selected @endif>50</option>
                                    <option value="100" @if($cars->perPage() == 100) selected @endif>100</option>
                                </select> Per Page
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div id="country_table_filter ">
                            <div class="form-group floating-label">
                                <input id="filter-table-searchInput" class="form-control" type="search" name="search"
                                       value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">
                                <label for="">Search</label>
                                <button style="    position: absolute;
    right: 9px;
    top: 16px;" id="filter-table-button" class="btn btn-icon-toggle ink-reaction" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                            <input id="filter-tableName-input" type="hidden" name="table"
                                   value="{{ isset($_GET['table']) ? $_GET['table'] : '' }}">
                            <input id="filter-tableOrder-input" type="hidden" name="order"
                                   value="{{ isset($_GET['order']) ? $_GET['order'] : '' }}">


                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover dataTable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th class="sorting" data-table="Car.title">Title</th>
                        <th class="sorting" data-table="Car.grade">Grade</th>
                        <th class="sorting" data-table="CarModel.model_name">Model</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i = $cars->firstItem())

                    @foreach($cars as $car)
                        <tr data-id="{{ $car->id }}">
                            <td>{{ $i }}</td>
                            <td>{{ $car->title }}</td>
                            <td>{{ $car->grade }}</td>
                            <td>{{ $car->model_name }}</td>
                        </tr>
                        @php($i++)

                    @endforeach
                    </tbody>
                </table>

            </form>
        </div><!--end .card-body -->
        <div class="card-body" style="padding-top: 0;padding-bottom: 0">
            <div class="row">
                <div class="col-sm-3" style="margin: 24px 0;">
                    Showing {{ $cars->firstItem() }} to {{ $cars->lastItem() }}
                    of {{ $cars->total() }}
                </div>
                <div class="col-sm-9 text-right">
                    {{$cars->appends(request()->input())->links()}}
                </div>
            </div>
        </div>

    </div>
</div>
@section('js')

    <script src="{{ Module::asset('commonbackend:admin_assets/js/includes/h-functions.js') }}"></script>
    <script>

        $(document).ready(function () {
            $('table.dataTable').setTableOrder({
                form: 'form#filters'
            });
            var spinner = $('.spinnerLoader');
            $('tbody tr').click(function () {
                var val = $(this).data('id');
                $.ajax({
                    url: '{{ route('admin.getAuctionForm') }}',
                    type: 'POST',
                    data: {'id': val},
                    dataType: 'html',
                    success: function (data) {
                        $('#auction-wrapper').html(data);
                    },
                    beforeSend: function () {
                        spinner.css('display', 'flex')
                    },
                    complete: function () {
                        spinner.hide();
                    }

                })

            });
        })
    </script>


@endsection