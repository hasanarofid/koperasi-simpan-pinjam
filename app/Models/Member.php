<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];

    public function savingAccounts()
    {
        return $this->hasMany(SavingAccount::class);
    }

    public function loanApplications()
    {
        return $this->hasMany(LoanApplication::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function group()
    {
        return $this->belongsTo(MemberGroup::class, 'member_group_id');
    }
}
