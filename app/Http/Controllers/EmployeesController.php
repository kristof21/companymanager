<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Session;


class EmployeesController extends Controller
{
    //Create employee view
    public function create(){
        $company = Company::pluck('name', 'id');
        if($company->count() > 0) {
            return view('employees.create')
                ->with('company', $company);
        }else{
            return Redirect::to('companies/create')
                ->withErrors("First create a company");
        }

    }
    //Store new employee
    public function store(Request $request){
        $employee = new Employee;
        $rules = array(
            'lastname' => ['required', 'string', 'max:25'],
            'firstname' => ['required', 'string', 'max:25'],
            'company' => 'required',
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'max:16']
        );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return Redirect::to('employee/create')
                ->withErrors($validator)
                ->withRequest($request->except('logo'));
        } else {
            $employee->lastname = $request->get('lastname');
            $employee->firstname = $request->get('firstname');
            $employee->email = $request->get('email');
            $employee->phone = $request->get('phone');
            $employee->company_id = $request->get('company');
            $employee->save();
            Session::flash('message', 'Successfully added an employee!');
            return Redirect::to('employee/create');
        }
    }
    //Sinlge employe where you can edit it
    public function show($id){
        $company = Company::pluck('name', 'id');
        $employee = Employee::find($id);
        //Acessing from url with invalid id
        if ($employee !== null) {
            return view('employees.show')
                ->with('employee', $employee)
                ->with('company', $company);
        }else{
            abort(404);
        }
    }
    //Edit employee
    public function edit(Request $request, $id){
        $rules = array(
            'lastname' => ['required', 'string', 'max:25'],
            'firstname' => ['required', 'string', 'max:25'],
            'company' => 'required',
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'max:16']
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('employee/show/' . $id)
                ->withErrors($validator)
                ->withRequest($request->all());
        } else {
            $employee = Employee::find($id);
            $employee->lastname = $request->get('lastname');
            $employee->firstname = $request->get('firstname');
            $employee->email = $request->get('email');
            $employee->phone = $request->get('phone');

            $employee->save();
            Session::flash('message', 'Successfully edited an employee!');
            return Redirect::to('employee/show/' . $id);
        }
    }
    //Remove Employee
    public function remove($id){
        $employee = Employee::find($id);
        $employee->delete();
        Session::flash('message', 'Successfully removed an employee!');
        return Redirect::to('companies/show/'. $employee->company_id);
    }


}
