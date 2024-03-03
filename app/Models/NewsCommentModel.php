<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCommentModel extends Model
{
    use HasFactory;
    protected $table = 'news_comments';
    protected $guarded =[];

    public function usersJoin()
    {
        return $this->join('users', 'news_comments.id_user', '=', 'users.id');
    }
}
