<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    protected $table = 'checklist_items';

    protected $fillable = [
        'checklist_id',
        'description',
        'is_completed',
    ];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }
}
