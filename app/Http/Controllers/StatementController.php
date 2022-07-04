<?php


namespace App\Http\Controllers;


use App\Role;
use App\Statement;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $statement =  DB::table(Statement::getTableName().' as s')
            ->join(User::getTableName().' as u','s.user_id','=','u.id')
            ->select('s.amount','s.type','s.details','s.balance','s.created_at','s.updated_at')
            ->where('s.user_id',Auth::user()->id)
            ->orderByDesc('s.created_at')
            ->paginate(20);


        return view('statement.index', compact('statement'));


    }
}
