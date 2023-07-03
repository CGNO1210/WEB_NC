<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DepositController extends Controller
{
    //
    public function showDepositForm() {
        return view('client.deposit');
    }
    public function processDeposit(Request $request) {
        try {
            $deposit =floatval($request->input('deposit'));
            $deposit_old =floatval(User::where('id', $request->input('id'))->first()->user_deposit);
            $deposit_new = $deposit + $deposit_old;
            User::where('id', $request->input('id'))->update([
                'user_deposit' => $deposit_new
            ]);
            
            Session()->put('user', User::where('id', $request->input('id'))->first());
            Session()->flash('success','Nạp thành công');
        } catch (Exception $ex){
            Session()->flash('error',$ex->getMessage());
            return redirect()->back();
        }
        return redirect('/');
    }
}
