<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $emp=Employee::all();
        return $emp;
    }

    public function store(Request $request)
    {
        $request->validate([
            "firstName"=>"required|string",
            "lastName"=>"required|string",
            "phoneNo"=>"required|numeric",
            "salary"=>"required|numeric",
        ]);
        // $emp=Employee::create($request->all());
        // $response=[
        //     "employee"=>$emp
        // ];
        // return response($response,201);
        return Employee::create($request->all());
    }

    public function show($id)
    {
        return Employee::find($id);
    }

    public function update(Request $request, $id)

    {
        $request->validate([
            "firstName"=>"required|string",
            "lastName"=>"required|string",
            "phoneNo"=>"required|numeric",
            "salary"=>"required|numeric",
        ]);
        $emp=Employee::find($id);
        $emp->update($request->all());
        return $emp;
    }
    public function destroy($id)
    {
        return Employee::destroy($id);
    }
}
