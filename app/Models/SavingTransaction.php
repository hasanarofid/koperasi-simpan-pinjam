<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingTransaction extends Model
{
    protected $guarded = [];

    public function savingAccount()
    {
        return $this->belongsTo(SavingAccount::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
