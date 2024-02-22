<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;
class TransactionController extends Controller
{
    public function transactions() {
        $transactions = Transaction::all();
        return view('transactions' , compact('transactions'));
    }
    public function index($id) {
    	$transactions = Transaction::where('account_id' , $id)->get();
    	return view('transactions' , compact('transactions'));
    }

    public function add_transaction($id , Request $request) {
        $transaction = new Transaction;
        $account = Account::find($id);
        $account_balance = $account->balance;
        $amount = $request->amount;
        if ($request->type === "Credit") {
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
                'type' => "Credit"
            ];
            $transaction->create($data1);
        }

        if ($request->type === "Debit") {
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
                'type' => "Debit"
            ];
            $transaction->create($data1);
        }

        return redirect(route('accounts'));
    }

    public function update_transaction($id , Request $request){
        $transaction =Transaction::find($id);
        $data = [
            "name" => $request->name,
            "number" => $request->number,
            "amount" => $request->amount,
            "type" => $request->type,
            "detail" => $request->detail
        ];
        $transaction->update($data);
        return redirect(url('/transactions'));
    }

    public function delete($id) {
        Transaction::destroy($id);
        return redirect(route('user_transactions'));
        // $employee->destroy();
    }
}
