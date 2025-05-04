<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'task_id';

    protected $fillable = [
        'project_id',
        'user_id',
        'content',
        'status',
    ];

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_id')->select('project_id', 'title'); 
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id')->select('user_id', 'name'); 
    }
}
