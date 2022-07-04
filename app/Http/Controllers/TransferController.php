<?php


namespace App\Http\Controllers;


use App\Deposit;
use App\Statement;
use App\Transfer;
use App\User;
use App\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        return view('transfer.create',compact('totalAmount'));

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
            'email' => 'required|email|max:190',

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

        $transfer = new Transfer();
        $transfer->user_id = Auth::user()->id;
        $transfer->amount = $request->amount;
        $transfer->email = $request->email;
        $transfer->save();

        $statement = new Statement();
        $statement->user_id = Auth::user()->id;
        $statement->amount = $request->amount;
        $statement->type = 1;
        $statement->details = 'Transfer to '.' '. $request->email;
        $statement->balance = $totalAmount - $request->amount;
        $statement->save();
        return redirect('/admin-panel')->with('msg_success', 'Amount Transferred Successfully');


    }

}
