<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'user_id',
    ];

    protected function serializeDate(\DateTimeInterface $date){
        return $date->format('Y-m-d H:i:s');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id'); 
    }

    public function project() {
        return $this->belongsTo(Project::class, 'project_id'); 
    }
}

