<?php


namespace App\Http\Controllers;


use App\Deposit;
use App\Role;
use App\Statement;
use App\Transfer;
use App\User;
use App\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepositController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('deposit.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'amount' => 'required',

        ]);

        $depositAmount = DB::table(User::getTableName().' as u')
            ->join(Deposit::getTableName().' as d','d.user_id','=','u.id')
            ->where('d.user_id',Auth::user()->id)
            ->sum('d.amount');

        $withdrawAmount = DB::table(User::getTableName().' as u')
            ->join(Withdraw::getTableName().' as w','w.user_id','=','u.id')
            ->where('w.user_id',Auth::user()->id)
            ->sum('w.amount');

        $transferAmount = DB::table(User::getTableName().' as u')
            ->join(Transfer::getTableName().' as t','t.user_id','=','u.id')
            ->where('t.user_id',Auth::user()->id)
            ->sum('t.amount');

        $totalAmount = $depositAmount - $withdrawAmount - $transferAmount;

        $deposit = new Deposit;
        $deposit->user_id = Auth::user()->id;
        $deposit->amount = $request->amount;
        $deposit->save();


        $statement = new Statement();
        $statement->user_id = Auth::user()->id;
        $statement->amount = $request->amount;
        $statement->type = 1;
        $statement->details = 'deposit';
        $statement->balance = $totalAmount + $request->amount;
        $statement->save();
        return redirect('/admin-panel')->with('msg_success', 'Amount Deposited Successfully');


    }


}
