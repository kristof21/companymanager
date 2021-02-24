<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Validator;
use Redirect;
use Session;
use File;
use App\Models\Employee;

class CompaniesController extends Controller
{

    //Index view
    public function index(){
        $companies = Company::withCount('employee')->get();
        return view('companies.index')
            ->with('companies', $companies);
    }
    //Company create view
    public function create(){
        return view('companies.create');
    }
    //Adding company to database
    public function store(Request $request){
        $rules = array(
            'name' => 'required',
            'email' => ['nullable', 'email'],
            'website' => ['nullable', 'url'],
            'logo' => ['nullable', 'image']
        );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return Redirect::to('companies/create')
                ->withErrors($validator)
                ->withRequest($request->except('logo'));
        } else{
            $company = new Company();
            $company->name = $request->get('name');
            $company->email = $request->get('email');
            $company->website = $request->get('website');
            if($request->logo != '') {
                $imagePath = $request->logo->store('uploads', 'public');
                $company->logo = $imagePath;
            }
            $company->save();
            Session::flash('message', 'Successfully added a company!');
            return Redirect::to('companies/create');
        }

    }
    //Single company with employee-s view
    public function show($id){
        $company = Company::find($id);
        //Accessing from url with invalid id
        if ($company !== null) {
            $employee = Employee::where('company_id', $id)->get();
            return view('companies.show')
                ->with('company', $company)
                ->with('employee', $employee);
        }else{
            abort(404);
        }
    }
    //Editing a company
    public function edit(Request $request,$id){
        $rules = array(
            'name' => 'required',
            'email' => ['nullable', 'email'],
            'website' => ['nullable', 'url'],
            'logo' => ['nullable', 'image']
        );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return Redirect::to('companies/show/'. $id)
                ->withErrors($validator)
                ->withRequest($request->except('logo'));
        } else {
            $company = Company::find($id);
            $company->name = $request->get('name');
            $company->email = $request->get('email');
            $company->website = $request->get('website');
            if ($request->logo != '') {
                $image_path = "storage/" . $company['logo'];  // Value is not URL but directory file path
                if(File::exists($image_path)) {
                    File::delete($image_path);
                }
                $imagePath = $request->logo->store('uploads', 'public');
                $company->logo = $imagePath;
            }else{
            }
            $company->save();
            Session::flash('message', 'Successfully edited a company!');
            return Redirect::to('companies/show/'. $id);
        }

    }
    //Removing a company with all of its employees
    public function remove($id){
        $company = Company::find($id);
        $image_path = "storage/" . $company['logo'];  // Value is not URL but directory file path
        var_dump($image_path);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $company->delete();
        Session::flash('message', 'Successfully removed a company!');
        return Redirect::to('companies');

    }
    public function removeLogo($id){
        $company = Company::find($id);
        $image_path = "storage/" . $company['logo'];  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $company->logo = null;
        $company->save();
        Session::flash('message', 'Successfully removed the logo!');
        return Redirect::to('companies/show/'. $id);
    }

}
