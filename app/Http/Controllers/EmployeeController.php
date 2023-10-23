<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
class EmployeeController extends Controller
{
	public function index() {
		$employees = Employee::all();
		return view('employee' , compact('employees'));
	}

	public function create(Request $request) {

		if($request->isMethod('POST')) {
			$employee = new Employee;
			$data = [
				'name' => $request->name,
				'number' => $request->number,
				'salary' => $request->salary
			];
			$employee->create($data);
			return redirect(route('employee'));
		}
	}

	public function update($id , Request $request) {
		$employee =Employee::find($id);
		$data = [
			"name" => $request->name,
			"number" => $request->number,
			"salary" => $request->salary
		];
		$employee->update($data);
		return redirect(route('employee'));
	}

	public function delete($id) {
		Employee::destroy($id);
		return redirect(route('employee'));
		// $employee->destroy();
	}
}
