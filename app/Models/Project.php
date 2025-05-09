<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'project_id';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
    ];

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    public function task() {
        return $this->hasMany(Task::class, 'project_id'); 
    }
}
