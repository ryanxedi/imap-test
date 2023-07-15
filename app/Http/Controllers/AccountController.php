<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Traits\TestTrait;

class AccountController extends Controller
{
    use TestTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();

        return view('accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'incoming_server' => 'required',
            'incoming_username' => 'required',
            'incoming_password' => 'required',
            'incoming_port' => 'required',
            'incoming_security' => 'required',
            'outgoing_server' => 'required',
            'outgoing_username' => 'required',
            'outgoing_password' => 'required',
            'outgoing_port' => 'required',
            'outgoing_security' => 'required',
        ]);

        Account::create($request->all());

        return redirect('/accounts')->with('success', 'Created successfully');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        return view('accounts.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $account->update($request->all());

        return redirect('/accounts')->with('success', 'Updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return back()->with('success', 'Deleted successfully');
    }

    public function test(Account $account)
    {
        $subject = Str::uuid()->toString();
        $send = $this->sendEmail($account, $subject);


        if ($send->statusText() == 'OK') {
            $check = $this->checkEmail($account, $subject);
            
            if ($check == true) {
                return back()->with('success', 'Message sent successfully and confirmed delivery');
            } else {
                return back()->with('failure', 'Message sent but not confirmed');
            }
        } else {
            return back()->with('failure', 'Message failed to send');
        }
    }
}
