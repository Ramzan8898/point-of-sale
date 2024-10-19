<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;

class TransactionController extends Controller
{
    public function transactions()
    {
        $transactions = Transaction::all();
        return view('transactions', compact('transactions'));
    }

    public function get_transactions($id, Request $request)
    {

        $transactions = Transaction::where('account_id', $id)->get();
        $account = Account::find($id);
        return view('transactions', compact('transactions', 'account'));
    }

    public function add_transaction($id, Request $request)
    {
        $transaction = new Transaction;
        $account = Account::find($id);
        $account_balance = $account->balance;
        $amount = $request->amount;
        if ($request->type === "کریڈت" || $request->type === "Credit") {
            $total_balance = (int)$account_balance + (int)$amount;
            $data = [
                'balance' => $total_balance
            ];
            $account->update($data);

            $data1 = [
                'account_id' => $account->id,
                'name' => $account->name,
                'number' => $account->number,
                'amount' => $request->amount,
                'detail' => $request->detail,
                'type' => "کریڈت"
            ];
            $transaction->create($data1);
        }

        if ($request->type === "Debit"  || $request->type === "ڈیبٹ") {
            $transaction = new Transaction;

            $total_balance = (int)$account_balance - (int)$amount;
            $data = [
                'balance' => $total_balance
            ];
            $account->update($data);

            $data1 = [
                'account_id' => $account->id,
                'name' => $account->name,
                'number' => $account->number,
                'amount' => $request->amount,
                'detail' => $request->detail,
                'type' => "ڈیبٹ"
            ];
            $transaction->create($data1);
        }

        return redirect(route('accounts'));
    }

    public function update_transaction($id, Request $request)
    {
        $transaction = Transaction::find($id);
        $accountId = $transaction->account_id;
        $account = Account::where('id', $accountId)->first();
        $account_balance = (int)$account->balance; 
        $amount = (int)$request->amount;
    
        if ($request->type === "کریڈت" || $request->type === "Credit") {
            $total_balance = $account_balance - $amount;
    
            $account->update(['balance' => $total_balance]);
    
            $data1 = [
                'account_id' => $accountId,
                'name' => $account->name,
                'number' => $account->number,
                'amount' => $request->amount,
                'detail' => $request->detail,
                'type' => "کریڈت"
            ];
            $transaction->update($data1);
        }
    
        if ($request->type === "Debit" || $request->type === "ڈیبٹ") {
            $total_balance = $account_balance + $amount;
    
            $account->update(['balance' => $total_balance]);
    
            $data1 = [
                'account_id' => $accountId,
                'name' => $account->name,
                'number' => $account->number,
                'amount' => $request->amount,
                'detail' => $request->detail,
                'type' => "ڈیبٹ"
            ];
            $transaction->update($data1);
        }
    
        return redirect(route('user_transactions', ['id' => $accountId]));
    }
    

    public function delete($id, Request $request)
    {
        // Find the transaction first to get the account_id
        $transaction = Transaction::findOrFail($id);
        $accountId = $transaction->account_id;

        // Delete the transaction
        Transaction::destroy($id);
        return redirect(route('user_transactions', ['id' => $accountId]));
    }
}
