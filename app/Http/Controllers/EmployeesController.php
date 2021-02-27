<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Session;


class EmployeesController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeesService $employeesService){
        $this->employeeService = $employeesService;
    }
    //Create employee view
    public function create(){
        $company = Company::pluck('name', 'id');
        if($company->count() > 0) {
            return view('employees.create')
                ->with('company', $company);
        }else{
            return redirect(route('companies/create'))
                ->withErrors("First create a company");
        }

    }
    //Store new employee
    public function store(Request $request){
    $this->employeeService->storeService($request);
    }
    //Sinlge employe where you can edit it
    public function show(Employee $employee){
        $company = Company::pluck('name', 'id');
            return view('employees.show')
                ->with('employee', $employee)
                ->with('company', $company);
    }
    //Edit employee
    public function edit(Request $request, Employee $employee){
        $this->employeeService->editService($request, $employee);
    }

    //Remove Employee
    public function remove(Employee $employee){
        $company = Company::where('id', $employee->company_id)->first();
        $employee->delete();
        Session::flash('message', 'Successfully removed an employee!');
        return redirect(route('companies.show', $company))->send();
    }


}
