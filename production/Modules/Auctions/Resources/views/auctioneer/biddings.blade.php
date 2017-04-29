@extends('commonbackend::layouts.admin_app')

@section('content')
    <div id="content">
        <section class="">
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-head">
                                <header class="text-primary section-header" style="line-height: 46px; margin-bottom: 0">
                                    {{ $auction->car->title }} Biddings
                                </header>
                            </div>
                            <div class="card-body dataTables_wrapper" style="padding-top: 0;">
                                <div class="col-md-12">
                                    @include('commonbackend::layouts._alert-response')
                                </div><!--end .col -->
                                <form method="post" id="filters"
                                      action="{{ route('auctioneer.auctionWinner', ['id' => $auction->id]) }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="" name="id">
                                    <table class="table table-striped table-hover dataTable">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>UserName</th>
                                            <th>Bidding Amount</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($i = 1)
                                        @foreach($auction->bidding as $bid)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $bid->user->username }}</td>
                                                <td>{{ $bid->bid_amount }}</td>
                                                <td width="150">
                                                    @if(!$auction->winner_user_id)
                                                        <button class="btnon" type="button" data-id="{{ $bid->user->id }}">
                                                            is winner?
                                                        </button>
                                                    @else
                                                        @if($auction->winner_user_id == $bid->user->id)
                                                            Winner
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                            @php($i++)
                                        @endforeach
                                        </tbody>
                                    </table>
                                </form>
                            </div><!--end .card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script src="{{ Module::asset('commonbackend:admin_assets/js/includes/h-functions.js') }}"></script>
    <script>
        $('.btnon').click(function (e) {
            e.preventDefault();
            $('input[name=id]').val($(this).data('id'));

            $('form').submit();
        });
    </script>
@endsection
