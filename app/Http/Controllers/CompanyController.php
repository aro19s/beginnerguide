<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\EmployeesRequest;
use App\Http\Requests\Company\DepartmentsRequest;
use App\Http\Requests\Company\UpdateDepartmentRequest;
use App\Http\Requests\Company\UpdateEmployeesRequest;
use App\Http\Requests\Company\TasksRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function createEmployees(EmployeesRequest $request)
    {
        try {
            $employeeInfo = Employee::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Employee registered successfully',
                'data' => $employeeInfo
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function createDepartments(DepartmentsRequest $request)
    {
        try {
            $departmentInfo = Department::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Department registered successfully',
                'data' => $departmentInfo
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function getEmployees($id)
    {
        try {
            $employees = Employee::with('departments')->findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Employee retrieved successfully',
                'data' => $employees,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function getDepartments($id)
    {
        try {
            $departments = Department::with('employees')->findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Departments retrieved successfully',
                'data' => $departments,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function getAllEmployees()
    {
        try {
            $perPage = 5;
            $allEmployees = Employee::with('departments')->paginate($perPage);
            return response()->json([
                'success' => true,
                'message' => 'Employees retrieved successfully',
                'data' => $allEmployees,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function getAllDepartments()
    {
        try {
            $perPage = 5;
            $allDepartments = Department::with('employees')->paginate($perPage);
            return response()->json([
                'success' => true,
                'message' => 'Departments retrieved successfully',
                'data' => $allDepartments,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function updateEmployee(UpdateEmployeesRequest $request, $id)
    {
        try {
            $employee = Employee::find($id);

            if (!$employee) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee does not exist',
                    'data' => null
                ], 404);
            }

            $employee->update($request->validated());
            if (empty($validatedData['employeeName'])) {
                $validatedData['employeeName'] = $employee->employeeName;
            }

            return response()->json([
                'success' => true,
                'message' => 'Employee updated successfully',
                'data' => $employee
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function updateDepartment(UpdateDepartmentRequest $request, $id)
    {
        try {
            $department = Department::find($id);

            if (!$department) {
                return response()->json([
                    'success' => false,
                    'message' => 'Department does not exist',
                    'data' => null
                ], 404);
            }

            $department->update($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Department updated successfully',
                'data' => $department
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function deleteEmployee($id)
    {
        try {
            $employee = Employee::find($id);

            if (!$employee) {
                return response()->json([
                    'success' => false,
                    'message' => 'Employee not found',
                    'data' => null
                ], 404);
            }

            $employee->delete();
            return response()->json([
                'success' => true,
                'message' => 'Employee deleted successfully',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function deleteDepartment($id)
    {
        try {
            $department = Department::find($id);

            if (!$department) {
                return response()->json([
                    'success' => false,
                    'message' => 'Department not found',
                    'data' => null
                ], 404);
            }

            $department->delete();
            return response()->json([
                'success' => true,
                'message' => 'Department deleted successfully',
                'data' => null
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function createTask(TasksRequest $request)
    {
        try {
            $task = Task::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Task registered successfully',
                'data' => $task
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

}
