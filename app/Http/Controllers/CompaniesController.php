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
    protected $companyService;

    public function __construct(CompaniesService $companiesService){
    $this->companyService = $companiesService;
    }
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
        $this->companyService->storeService($request);
    }
    //Single company with employee-s view
    public function show(Company $company){
            $employee = Employee::where('company_id', $company->id)->get();
            return view('companies.show')
                ->with('company', $company)
                ->with('employee', $employee);
    }
    //Editing a company
    public function edit(Request $request, Company $company){
        $this->companyService->editService($request, $company);
    }
    //Removing a company with all of its employees
    public function remove(Company $company){
        $image_path = "storage/" . $company['logo'];  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $company->delete();
        Session::flash('message', 'Successfully removed a company!');
        return redirect(route('companies.index'))->send();

    }
    public function removeLogo(Company $company){
        $image_path = "storage/" . $company['logo'];  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $company->logo = null;
        $company->save();
        Session::flash('message', 'Successfully removed the logo!');
        return Redirect::to('companies/show/'. $company->id);
    }

}
