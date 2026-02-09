<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InvitationController extends Controller
{
    public function invite(Request $request)
    {
        if($request->isMethod('post')){
            $rules = [
                'name'       => 'required|string|max:255',
                'company_id' => 'required|exists:companies,id',
                'role'       => 'required|string|max:100',
                'email'      => 'required|email|max:255|unique:users,email',
            ];

            $messages = [
                'name.required'        => 'User name is required',
                'company_id.required'  => 'Please select a company',
                'company_id.exists'    => 'Selected company is invalid',
                'role.required'        => 'Role is required',
                'email.required'       => 'Email is required',
                'email.email'          => 'Enter a valid email address',
                'email.unique'         => 'This email is already taken',
                'password.required'    => 'Password is required',
                'password.min'         => 'Password must be at least 6 characters',
                'password.confirmed'   => 'Password confirmation does not match',
            ];

            $validated = $request->validate($rules, $messages);

            $data = [
                'name'       => $validated['name'],
                'company_id' => $validated['company_id'],
                'role'       => $validated['role'],
                'email'      => $validated['email'],
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            User::create($data);

            return back()->with('success', 'Invitation sent successfully.');
        }

        $currentUser = Auth::user();
        $users = User::whereNot('role','Super Admin')->latest();
        $companies = Company::latest();

        if(in_array($currentUser->role,["Admin","Member"])){
            $users = $users->where('company_id',$currentUser->company_id);
            $companies = $companies->where('id',$currentUser->company_id);
        }

        $users = $users->get();
        $companies = $companies->get();

        $roles = ["Admin","Member"];
        
        return view('invite.index',compact('users','companies','roles'));
    }
}
