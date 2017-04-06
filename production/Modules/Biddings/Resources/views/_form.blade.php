<div class="card">
    <div class="card-head style-primary">
        <header>{{ $title }}</header>
    </div>
    <div class="card-body floating-label">
        <div class="form-group{{ $errors->has('auction_id') ? ' has-error' : '' }}">

            {{ Form::select('auction_id', isset($bid)?[$bid->auction_id=>$bid->auction->car->title]:[], null,['class' => 'js-data-example-ajax form-control', 'placeholder' => 'Select Auction']) }}
            @if ($errors->has('auction_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('auction_id') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">

            {{ Form::select('user_id', isset($bid)?[$bid->user_id=>$bid->user->full_name]:[], null,['class' => 'js-data-user-ajax form-control', 'placeholder' => 'Select User']) }}
            @if ($errors->has('user_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('user_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('bid_amount') ? ' has-error' : '' }}">
            {{ Form::text('bid_amount', null ,['class' => 'form-control']) }}
            {{ Form::label('bid_amount', 'Bid Amount:') }}
            <span id="bidamount"  class="help-block">
{{ isset($bid->auction)? 'Min bid amount is '. $bid->auction->bid_starting_amount : null }}
            @if ($errors->has('bid_amount'))
                    <strong>{{ $errors->first('bid_amount') }}</strong>
            @endif
                            </span>

        </div>


    </div><!--end .card-body -->
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

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>

        var publicUrl = '{{ asset('/') }}',
                min;

        min = {{ isset($bid->auction)? $bid->auction->bid_starting_amount : 0 }}
        $(".js-data-example-ajax").select2({
            ajax: {
                url: "{{ route('admin.searchAuction') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
        }).on("select2:select", function (e) {
            min =  e.params.data.min;
            $('#bidamount').html('Min bid amount is '+ min);
        });
        $(".js-data-user-ajax").select2({
            ajax: {
                url: "{{ route('admin.searchUser') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: $.trim(params.term)
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatUser, // omitted for brevity, see the source of this page
        });
        function formatUser (repo) {
            if (repo.loading) return repo.text;

            var img = repo.info.picture;
            if(img){
                if(img.search(/http/) == -1){
                    img = publicUrl+img;
                }
            }else{
                img = 'http://placehold.it/60x45';
            }
            var markup = "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__avatar'><img src='"+img+"' /></div>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'>" + repo.info.full_name + "</div>";

            markup += "<div class='select2-result-repository__statistics'>" +
                    "<div class='select2-result-repository__forks'><i class='fa fa-phone'></i> " + repo.info.contact_number + "</div>" +
                    "<div class='select2-result-repository__forks'><i class='fa fa-envelop'></i> " + repo.info.email + "</div>" +
                    "<div class='select2-result-repository__watchers'><i class='fa fa-user'></i> " + repo.info.user_role + "</div>" +
                    "</div>" +
                    "</div></div>";

            return markup;
        }

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

        $('form').submit(function (e) {
            e.preventDefault();
            var val = parseInt($('input[name=bid_amount]').val());

            if(min > val){
                alert('Bid amount should be greater than minimum bid amount of selected auction!');
            }else{
                $(this)[0].submit();
            }


        })

    </script>
@endsection
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

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