<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employe;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Session;


class EmployeesController extends Controller
{
    //Create employe view
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
    //Store new employe
    public function store(Request $request){
        $employee = new Employe;
        $rules = array(
            'lastname' => ['required', 'string', 'max:25'],
            'surname' => ['required', 'string', 'max:25'],
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
            $employee->surname = $request->get('surname');
            $employee->email = $request->get('email');
            $employee->phone = $request->get('phone');
            $employee->company_id = $request->get('company');
            $employee->save();
            Session::flash('message', 'Successfully added an employe!');
            return Redirect::to('employee/create');
        }
    }
    //Sinlge employe where you can edit it
    public function show($id){
        $company = Company::pluck('name', 'id');
        $employe = Employe::find($id);
        //Acessing from url with invalid id
        if ($employe !== null) {
            return view('employees.show')
                ->with('employe', $employe)
                ->with('company', $company);
        }else{
            abort(404);
        }
    }
    //Edit employe
    public function edit(Request $request, $id){
        $rules = array(
            'lastname' => ['required', 'string', 'max:25'],
            'surname' => ['required', 'string', 'max:25'],
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
            $employee = Employe::find($id);
            $employee->lastname = $request->get('lastname');
            $employee->surname = $request->get('surname');
            $employee->email = $request->get('email');
            $employee->phone = $request->get('phone');

            $employee->save();
            Session::flash('message', 'Successfully edited an employee!');
            return Redirect::to('employee/show/' . $id);
        }
    }
    //Remove Employe
    public function remove($id){
        $employe = Employe::find($id);
        $employe->delete();
        Session::flash('message', 'Successfully removed an employe!');
        return Redirect::to('companies/show/'. $employe->company_id);
    }


}
