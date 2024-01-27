<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\charts\LaravelChart;
use App\Models\Transaction;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('dashboard');
    }

    public function getRecords(Request $request)
    {

        if($request->radio_value == 'monthly'){

            $transactions = Transaction::whereMonth('created_at', date('m'))->all();
            $data = [
                'transactions' => $transactions,
            ];
            return $data;
        }

        if($request->radio_value == 'daily'){

            $transactions = Transaction::whereDate('created_at', Carbon::today())->all();
            $data = [
                'transactions' => $transactions,
            ];
            return $data;
        }

        if($request->radio_value == 'weekly'){
            $date = Carbon::today()->subDays(7);

            $transactions = Transaction::where('created_at','>=',$date)->all();
            $data = [
                'transactions' => $transactions,
            ];
            return $data;
        }

        return view('transactions' , compact('transactions'));
    }

    public function logout(){
        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }


}
