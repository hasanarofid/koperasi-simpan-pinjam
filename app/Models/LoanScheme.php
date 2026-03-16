<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanScheme extends Model
{
    protected $guarded = [];

    public function loanApplications()
    {
        return $this->hasMany(LoanApplication::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
