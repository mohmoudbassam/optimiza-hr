<?php

namespace App\Http\Controllers\CP;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::query()
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->paginate(5)
            ->through(function ($company) {
                return [
                    'id' => $company->id,
                    'name' => $company->name,
                    'email' => $company->email,
                    'website' => $company->website,
                ];
            })
            ->withQueryString();
        return inertia('Company/Index', [
            'companies' => $companies,
            'filters' => $request->only('search')
        ]);
    }

    public function create(){
       return inertia('Company/Create');
    }

    public function store(CreateCompanyRequest $request)
    {
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('image', 'public');
        }else{
            $image_path=null;
        }
        Company::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $image_path
        ]);
        return redirect()->route('companies.index')->with('success', 'Company Created Successfully');
    }

    public function edit(Request $request)
    {
        $company=Company::query()->findOrFail($request->id);

        return inertia('Company/Edit',[
            'company'=>$company->only('id','name','email','website','profile_photo_url')
        ]);

    }

    public function update(UpdateCompanyRequest $request){
        $company=Company::query()->findOrFail($request->id);

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('image', 'public');
        }else{
            $image_path=$company->logo;
        }
        $company->update([
            'name'=>$request->name,
            'email'=>$request->email,
             'website'=>$request->website,
            'logo'=>$image_path,
        ]);
    }

    public function destroy(Request $request)
    {
        $user=Company::query()->findOrFail($request->id);
        $user->delete();
    }

}
