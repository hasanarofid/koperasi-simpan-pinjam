<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanInstallment extends Model
{
    protected $guarded = [];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function payments()
    {
        return $this->hasMany(LoanPayment::class);
    }
}
