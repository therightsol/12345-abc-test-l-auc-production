<div class="card">
    <div class="card-head style-primary">
        <header>{{ $title }} </header>
    </div>
    <div class="card-body floating-label">
        <div class="form-group{{ $errors->has('car_id') ? ' has-error' : '' }}">
            {{ Form::select('car_id', isset($auction)?[$auction->car->id=>$auction->car->title]:[], null,['class' => 'js-data-example-ajax form-control', 'placeholder' => 'Select Car']) }}
            @if ($errors->has('car_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('car_id') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('bid_starting_amount') ? ' has-error' : '' }}">
            {{ Form::text('bid_starting_amount', null ,['class' => 'form-control']) }}
            {{ Form::label('bid_starting_amount', 'Starting Amount:') }}
            @if ($errors->has('bid_starting_amount'))
                <span class="help-block">
                    <strong>{{ $errors->first('bid_starting_amount') }}</strong>
                </span>
            @endif
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                    {{ Form::text('start_date', isset($auction)? date('d F Y', strtotime($auction->start_date)).' -- '. $auction->start_time :null ,['class' => 'form-control']) }}
                    {{ Form::label('start_date', 'Start Date:') }}
                    @if ($errors->has('start_date'))
                        <span class="help-block">
                    <strong>{{ $errors->first('start_date') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                    {{ Form::text('end_date', isset($auction)? date('d F Y', strtotime($auction->end_date)).' -- '. $auction->end_time :null ,['class' => 'form-control']) }}
                    {{ Form::label('end_date', 'End Date:') }}
                    @if ($errors->has('end_date'))
                        <span class="help-block">
                    <strong>{{ $errors->first('end_date') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div>


        <div class="card-actionbar">
            <div class="card-actionbar-row">
                {{--  @if(url()->current() !== url()->previous())
                      <a href="{{ url()->previous() }}" class="btn btn-flat btn-primary ink-reaction pull-left">Go Back</a>
                  @endif--}}
                <button type="submit" class="btn btn-flat btn-primary ink-reaction">{{ $buttonText }}</button>
            </div>
        </div>
        <div class="spinnerLoader">
            <i class="ajax-loader medium animate-spin"></i>
        </div>

    </div>
</div>

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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
    <script>

        var publicUrl = '{{ asset('/') }}';
        $(".js-data-example-ajax").select2({
            ajax: {
                url: "{{ route('admin.searchCar') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    console.log(data);
                    return {
                        results: data
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
        });
        function formatRepo (repo) {
            if (repo.loading) return repo.text;
            var img = repo.info.meta;

            if(img.length){
                img = publicUrl+img[0].meta_value;
            }else{
                img = 'http://placehold.it/60x45';
            }
            var markup = "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__avatar'><img src='"+img+"' /></div>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'>" + repo.info.title + "</div>";

            markup += "<div class='select2-result-repository__statistics'>" +
                    "<div class='select2-result-repository__forks'><i class='fa fa-car'></i> " + repo.info.car_model.model_name + " Model</div>" +
                    "<div class='select2-result-repository__forks'><i class='fa fa-ravelry'></i> " + repo.info.car_model.car_company.company_name + " Company</div>" +
                    "<div class='select2-result-repository__watchers'><i class='fa fa-clock-o'></i> " + repo.info.manufacturing_year + " Year</div>" +
                    "</div>" +
                    "</div></div>";

            return markup;
        }


    </script>
@endsection
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link href="{{Module::asset('commonbackend:admin_assets/timepicker/bootstrap-datetimepicker.min.css')}}"
          rel="stylesheet">
    <style>
        .select2-result-repository {
            padding-top: 4px;
            padding-bottom: 3px;
        }
        .select2-result-repository__avatar {
            float: left;
            width: 60px;
            margin-right: 10px;
        }
        .select2-result-repository__meta {
            margin-left: 70px;
        }
        .select2-result-repository__avatar img {
            width: 100%;
            height: auto;
            border-radius: 2px;
        }
        .select2-result-repository__title {
            color: black;
            font-weight: bold;
            word-wrap: break-word;
            line-height: 1.1;
            margin-bottom: 4px;
        }
        .select2-result-repository__forks, .select2-result-repository__stargazers, .select2-result-repository__watchers {
            display: inline-block;
            color: #aaa;
            font-size: 11px;
        }
        .select2-results__option--highlighted .select2-result-repository__title {
            color: white;
        }
        .select2-results__option--highlighted .select2-result-repository__forks, .select2-results__option--highlighted .select2-result-repository__stargazers, .select2-results__option--highlighted .select2-result-repository__description, .select2-results__option--highlighted .select2-result-repository__watchers {
            color: #c6dcef;
        }
        .select2-result-repository__forks, .select2-result-repository__stargazers {
            margin-right: 1em;
        }
    </style>
@endsection