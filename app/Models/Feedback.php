<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    protected $fillable = ['title', 'description', 'category_id','user_id'];

    public function userData(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function categoryDate(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    // public function feedbackComments(){
    //     return $this->hasMany(FeedbackComment::class,'feedback_id','id');
    // }
    
}
