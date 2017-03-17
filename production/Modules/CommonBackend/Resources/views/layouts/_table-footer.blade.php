<div class="card-body" style="padding-top: 0;padding-bottom: 0">
    <div class="row">
        <div class="col-sm-3" style="margin: 24px 0;">
            Showing {{ $obj->firstItem() }} to {{ $obj->lastItem() }}
            of {{ $obj->total() }}
        </div>
        <div class="col-sm-9 text-right">
            {{$obj->appends(request()->input())->links()}}
        </div>
    </div>
</div>