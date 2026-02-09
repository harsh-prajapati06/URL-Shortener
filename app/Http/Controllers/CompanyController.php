<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index(Company $company = null)
    {
        $companies = Company::latest()->get();
        return view('companies.index', compact('companies', 'company'));
    }

    public function save(Request $request, Company $company = null)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Company::updateOrCreate(
            ['id' => $company?->id],
            [
                'name' => $request->name,
            ]
        );

        return redirect()->route('companies.view');
    }
}
