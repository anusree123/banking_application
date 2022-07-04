<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\Role;
use App\Transfer;
use App\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//            $users_count = User::where('admin', 0)->count();
            $users_count = DB::table(User::getTableName().' as u')
                ->join(Role::getTableName().' as r','r.user_id','=','u.id')
               ->count();

            $userName = Auth::user();

           $details = User::select('email')->where('id',Auth::user()->id)->first();


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


            return view('adminPanel', compact('users_count','userName','details','totalAmount'));

    }

}
