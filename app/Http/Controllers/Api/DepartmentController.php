<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __invoke(Request $request)
    {
        $departements = Department::all();

        return response()->json([
            'message' => 'Departments fetched successfully',
            'data' => $departements
        ], 200);
    }
}
