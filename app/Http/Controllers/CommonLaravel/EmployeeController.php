<?php

namespace App\Http\Controllers\CommonLaravel;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\UserHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    
    function index() {
        $models = User::where('owner_id', $this->userId())
                    ->with('permissions')
                    ->orderBy('created_at', 'DESC')
                    ->get();
        return response()->json(['models' => $models], 200);
    }      

    function update(Request $request, $id) {
        $model = User::where('id', $request->id)
                        ->first();

        $model->permissions()->sync($request->permissions_id);
        $model->name                = $request->name;
        $model->visible_password    = $request->visible_password;
        $model->password            = bcrypt($request->visible_password);
        if ($model->doc_number == $request->doc_number || !$this->docNumerRegister($request->doc_number)) {
            $model->doc_number          = $request->doc_number;
        }
        $model->save();

        $model = User::where('id', $request->id)
                        ->with('permissions')
                        ->first();
        return response()->json(['model' => $model], 200);
    }

    function destroy($id) {
        $user = User::find($id);
        $user->delete();
    }

    function store(Request $request) {
        $user = auth()->user();


        if ($this->docNumerRegister($request->doc_number)) {
            $model = User::create([
                'name'              => ucfirst($request->name),
                'doc_number'        => $request->doc_number,
                'visible_password'  => $request->visible_password,
                'password'          => Hash::make($request->visible_password),
                'owner_id'          => $this->userId(),
                'created_at'        => Carbon::now(),
            ]);

            $model->permissions()->attach($request->permissions_id);
            $model = User::where('id', $model->id)
                                ->with('permissions')
                                ->first();
            return response()->json(['model' => $model], 201);
        } else {
            return response()->json(['model' => false], 200);
        }
    }

    function docNumerRegister($doc_number) {
        $model = User::where('doc_number', $doc_number)
                        ->first();
        return !is_null($model);
    }
    
}
