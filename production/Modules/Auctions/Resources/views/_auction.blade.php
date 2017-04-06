<div class="col-lg-6 col-lg-offset-2">
    {!! Form::open(['route' => 'admin.auctions.store', 'method'=>'post', 'class' => 'form']) !!}

    @include('auctions::_form', [
    'buttonText' => 'Submit',
    'title' => 'Add Auction',
    ])
    {!! Form::close() !!}
</div>
@section('js')
    <script src="{{ Module::asset('commonbackend:admin_assets/timepicker/bootstrap-datetimepicker.min.js') }}"></script>

    <script>
        $('input[name=start_date]').datetimepicker({
            format: 'dd MM yyyy -- hh:ii:ss',
            autoclose: true,
            todayBtn: true,
            startDate: "{{ \Carbon\Carbon::now() }}",
        });
        $('input[name=end_date]').datetimepicker({
            format: 'dd MM yyyy -- hh:ii:ss',
            autoclose: true,
            todayBtn: true,
            startDate: "{{ \Carbon\Carbon::now() }}",
        });

    </script>




@endsection