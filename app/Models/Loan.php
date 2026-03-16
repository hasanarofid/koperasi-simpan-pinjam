<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function application()
    {
        return $this->belongsTo(LoanApplication::class, 'loan_application_id');
    }

    public function loanScheme()
    {
        return $this->belongsTo(LoanScheme::class, 'loan_scheme_id');
    }

    public function installments()
    {
        return $this->hasMany(LoanInstallment::class);
    }

    public function payments()
    {
        return $this->hasMany(LoanPayment::class);
    }
}
