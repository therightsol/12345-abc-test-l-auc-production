@extends( Module::get('commonbackend') != NULL ? 'commonbackend::layouts.grid': 'users::layouts.master', ['pageTitle' => 'Users', 'obj' => $users] )



@section('table')
    <table class="table table-striped table-hover dataTable">
        <thead>
        <tr>
            <th></th>
            <th class="sorting" data-table="UserModel.full_name">Full Name</th>
            <th class="sorting" data-table="UserModel.cnic">CNIC</th>
            <th class="sorting" data-table="UserModel.email">Email Address</th>
            <th class="sorting" data-table="UserModel.contact_number">Contact #</th>
            <th class="sorting" data-table="UserModel.user_role">Role</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr data-type="orderUser" data-id="{{ $user->id }}">
                <td>
                    @if(empty($user->picture))
                        @php( $url = url('/' ) . '/images/image-not-found-100x100.png' )

                    @else
                        @php( $url = url('/' ) . '/' . $user->picture )
                    @endif

                    <img class="width-1" src="{{ $url }}"
                         alt=""/>
                </td>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->cnic }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->contact_number }}</td>
                <td><span  class="user {{ $user->user_role }}">{{ strtoupper($user->user_role) }}</span></td>
                <td width="150">
                    <a href="{{ route('admin.users.edit', [$user->id]) }}" type="button" class="btn btn-icon-toggle" data-toggle="tooltip"
                       data-placement="top" data-original-title="Edit row">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <button type="button" class="btn delete-row btn-icon-toggle"
                            data-id="{{ $user->id }}" data-toggle="tooltip"
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
        .user{
            padding: 4px;
            border-radius: 4px;
            color: white;
            font-size: 1em;
            box-shadow: 0px 1px 0px #5d5353;
        }

        .auctioneer{
            background: #1c9fa6;
        }

        .staff{
            background: #5AB953;
        }

        .admin{
            background: #b174d9;
        }

        .bidder{
            background: #0B486B;
        }

        .inactive{
            background: #ED2740;
        }
    </style>


@endsection