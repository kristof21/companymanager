<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Validator;
use Session;
use Redirect;
use File;

class CompaniesService extends Controller
{

    public function storeService(Request $request)
    {
        $rules = new CompanyRequest();
        $validator = Validator::make($request->all(), $rules->rules());
        if ($validator->fails()) {
            return redirect(route('companies.create'))->send()
                ->withErrors($validator)
                ->withRequest($request->except('logo'));
        } else {
            $company = new Company();
            $imagePath = null;
            if ($request->logo != '') {
                $imagePath = $request->logo->store('uploads', 'public');
            }
            $data = $request->all();
            $data['logo'] = $imagePath;

            $company->create($data);
            Session::flash('message', 'Successfully added a company!');
            return redirect(route('companies.create'))->send();
        }
    }
    public function editService(Request $request, Company $company){
        $rules = new CompanyRequest();
        $validator = Validator::make($request->all(), $rules->rules());
        if($validator->fails()){
            return redirect(route('companies.show', $company))->send()
                ->withErrors($validator)
                ->withRequest($request->except('logo'));
        } else {
            $imagePath = null;
            if ($request->logo != '') {
                $image_path = "storage/" . $company['logo'];  // Value is not URL but directory file path
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
                $imagePath = $request->logo->store('uploads', 'public');
            }
            $data = $request->all();
            $data['logo'] = $imagePath;
            $company->update($data);
            Session::flash('message', 'Successfully edited a company!');
            return redirect(route('companies.show', $company))->send();
        }
    }

}
