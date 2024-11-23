<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $table = 'checklists';

    protected $fillable = [
        'user_id',
        'title',
    ];

    public function items()
    {
        return $this->hasMany(ChecklistItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
