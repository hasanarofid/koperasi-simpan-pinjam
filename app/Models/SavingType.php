<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingType extends Model
{
    protected $guarded = [];

    public function savingAccounts()
    {
        return $this->hasMany(SavingAccount::class);
    }
}
