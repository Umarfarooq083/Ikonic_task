<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackComment extends Model
{
    use HasFactory;
    protected $table = 'feedback_comments';
    protected $fillable = [
        'feedback_id','comment','user_id','created_at','updated_at'
    ];

    public function userData(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
