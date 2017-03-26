<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\UserModel;

class Post extends Model
{
    //

    protected $fillable = ['title','short_description','content','post_type','slug','parent_id','post_status_id','user_id', 'images', 'featured_image'];


    public function user(){
        return $this->belongsTo(UserModel::class);
    }

    public function post_status(){
        return $this->hasOne(PostStatus::class);
    }


    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }


}
