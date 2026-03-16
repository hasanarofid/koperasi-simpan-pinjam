<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = \App\Models\Member::all();
        $savingTypes = \App\Models\SavingType::all();
        $loanSchemes = \App\Models\LoanScheme::all();
        $admin = \App\Models\User::first();

        foreach ($members as $member) {
            // Create a few saving accounts for each member
            foreach ($savingTypes as $type) {
                $account = \App\Models\SavingAccount::create([
                    'member_id' => $member->id,
                    'saving_type_id' => $type->id,
                    'account_number' => 'SA-' . $member->id . '-' . $type->id,
                    'balance' => 0, // initially
                    'status' => 'active',
                ]);

                // Initial deposit
                $amount = rand(500000, 5000000);
                \App\Models\SavingTransaction::create([
                    'saving_account_id' => $account->id,
                    'transaction_type' => 'deposit',
                    'amount' => $amount,
                    'balance_after' => $amount,
                    'reference_number' => 'DEP-' . $account->id . '-' . time() . rand(1, 100),
                    'description' => 'Setoran awal',
                    'transaction_date' => $member->registration_date,
                    'user_id' => $admin->id,
                ]);

                $account->update(['balance' => $amount]);
            }

            // Create a loan for some members
            if (rand(0, 1)) {
                $scheme = $loanSchemes->random();
                $loanAmount = rand($scheme->min_amount, $scheme->max_amount / 2);
                
                // Need LoanApplication first
                $application = \App\Models\LoanApplication::create([
                    'member_id' => $member->id,
                    'loan_scheme_id' => $scheme->id,
                    'amount_requested' => $loanAmount,
                    'duration_months' => 12,
                    'purpose' => 'Modal usaha',
                    'status' => 'approved',
                    'reviewer_id' => $admin->id,
                ]);

                $monthlyPrincipal = $loanAmount / 12;
                $monthlyInterest = $loanAmount * $scheme->interest_rate / 100;
                $totalMonthly = $monthlyPrincipal + $monthlyInterest;

                $loan = \App\Models\Loan::create([
                    'member_id' => $member->id,
                    'loan_application_id' => $application->id,
                    'loan_scheme_id' => $scheme->id,
                    'loan_number' => 'LN-' . $member->id . '-' . time() . rand(1, 100),
                    'principal_amount' => $loanAmount,
                    'interest_rate' => $scheme->interest_rate,
                    'duration_months' => 12,
                    'monthly_installment' => $totalMonthly,
                    'remaining_balance' => $totalMonthly * 12,
                    'purpose' => 'Modal usaha',
                    'status' => 'active',
                    'disbursement_date' => now()->subMonths(3),
                ]);

                // Create some installments
                $monthlyPrincipal = $loanAmount / 12;
                $monthlyInterest = $loanAmount * $scheme->interest_rate / 100;
                $totalMonthly = $monthlyPrincipal + $monthlyInterest;

                for ($i = 1; $i <= 12; $i++) {
                    $installment = \App\Models\LoanInstallment::create([
                        'loan_id' => $loan->id,
                        'installment_number' => $i,
                        'due_date' => \Carbon\Carbon::parse($loan->disbursement_date)->addMonths($i),
                        'principal_amount' => $monthlyPrincipal,
                        'interest_amount' => $monthlyInterest,
                        'total_amount' => $totalMonthly,
                        'paid_amount' => $i <= 3 ? $totalMonthly : 0,
                        'status' => $i <= 3 ? 'paid' : 'unpaid',
                    ]);

                    if ($i <= 3) {
                        $loan->decrement('remaining_balance', $totalMonthly);
                    }
                }
            }
        }
    }
}
