<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;

class AccountsController extends Controller
{
	public function index() {
		$accounts = Account::orderBy('created_at' , 'DESC')->get();
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

}
