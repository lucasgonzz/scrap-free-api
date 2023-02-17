<?php

namespace App\Http\Controllers\CommonLaravel;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    function index() {
        $models = Permission::all();
        return response()->json(['models' => $models], 200);
    }
}
