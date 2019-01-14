<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     /*   $customer = User::whereHas('roles', function($q)
        {
            $q->where('name', 'customer');
        })->get();*/

         $customer =  DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',1)->get();
        return view('admin.users.customers.index')->with('customer', $customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.customers.show')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('auth.user-profile-edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'lga_id' => 'required',
            'address' => 'required',
        ]);
        $user->update($request->all());
        $customer = $request->get('customer');
        $customer->update($request->except('email'));
        return redirect()->route('customers.orders.index2')->with('success','You have successfully updated your profile');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function myProfile()
    {
        $customer = \request()->get('customer');

        return view('user.customer-profile', compact('customer'));
    }

}
