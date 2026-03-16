<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingAccount extends Model
{
    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function savingType()
    {
        return $this->belongsTo(SavingType::class);
    }

    public function transactions()
    {
        return $this->hasMany(SavingTransaction::class);
    }
}
