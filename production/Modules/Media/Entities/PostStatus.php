<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;

class PostStatus extends Model
{
    //

    protected $table = 'post_statuses';

    public function getForeignKey()
    {
        return 'status';
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
