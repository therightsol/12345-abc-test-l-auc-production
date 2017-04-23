<?php

namespace Modules\Biddings\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Auctions\Entities\Auction;
use Modules\CommonBackend\Entities\BaseModel;
use Modules\Users\Entities\UserModel;

class Bidding extends BaseModel
{
    protected $fillable = ['bid_amount', 'user_id', 'auction_id'];

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }
}
