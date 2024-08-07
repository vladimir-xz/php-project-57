<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status_id',
        'assigned_to_id'
    ];

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }
}
