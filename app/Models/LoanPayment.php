<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanPayment extends Model
{
    protected $guarded = [];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function installment()
    {
        return $this->belongsTo(LoanInstallment::class, 'loan_installment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
