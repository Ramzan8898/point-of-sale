<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;

class AccountsController extends Controller
{
	public function index() {
		$accounts = Account::all();
		return view('accounts' , compact('accounts'));
	}

	public function create(Request $request) {

		if($request->isMethod('POST')) {
			$account = new Account;
			$data = [
				'name' => $request->name,
				'number' => $request->number,
				'balance' => $request->balance
			];
			$account->create($data);
			return redirect(route('accounts'));
		}
	}

	public function update($id , Request $request) {
		$account =Account::find($id);
		$data = [
			"name" => $request->name,
			"number" => $request->number,
			"balance" => $request->balance
		];
		$account->update($data);
		return redirect(route('accounts'));
	}

	public function delete($id) {
		Account::destroy($id);
		return redirect(route('accounts'));
		// $employee->destroy();
	}

	public function add_balance($id , Request $request) {
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

		// dd($account);
		return redirect(route('accounts'));
	}

}
