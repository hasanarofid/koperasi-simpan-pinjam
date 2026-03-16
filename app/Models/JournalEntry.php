<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(JournalDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
