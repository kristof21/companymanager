<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use Session;

class EmployeesService extends Controller
{
    public function storeService(Request $request){
        $rules = new EmployeeRequest();
        $validator = Validator::make($request->all(), $rules->rules());
        if($validator->fails()){
            return redirect(route('employee.create'))->send()
                ->withErrors($validator)
                ->withRequest();
        } else {
            $employee = new Employee;
            $data= $request->all();
            var_dump($request->all());
            $employee->create($request->all());
            Session::flash('message', 'Successfully added an employee!');
            return redirect(route('employee.create'))->send();
        }
    }
    public function editService(Request $request, Employee $employee){
        $rules = new EmployeeRequest();
        $validator = Validator::make($request->all(), $rules->rules());
        if ($validator->fails()) {
            return redirect(route('employee.show', $employee))->send()
                ->withErrors($validator)
                ->withRequest($request->all());
        } else {
            $employee->lastname = $request->get('lastname');
            $employee->firstname = $request->get('firstname');
            $employee->email = $request->get('email');
            $employee->phone = $request->get('phone');
            $data = $request->all();
            $employee->update($data);
            $employee->save();
            Session::flash('message', 'Successfully edited an employee!');
            return redirect(route('employee.show', $employee))->send();
        }
    }
}
