<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'project_id',
        'user_id',
        'comment',
    ];

    protected function serializeDate(\DateTimeInterface $date){
        $today = Carbon::instance($date)->isToday();
        if($today) {
            return $date->format('H:i:s');
        }else {
            // 댓글 기능은 일자를 날짜만 둠 (시간x)
            return $date->format('Y-m-d');
        }
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_id'); 
    }
}
