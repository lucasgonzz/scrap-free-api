<?php

namespace App\Http\Controllers\CommonLaravel;

use App\Http\Controllers\Controller;
use App\Models\Error;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    function store(Request $request) {
        if (isset($request->message)) {
            $model = Error::create([
                'message'   => $request->message,
                'file'      => isset($request->file) ? $request->file : null,
                'line'      => isset($request->line) ? $request->line : null,
                'user_id'   => $this->userId(),
            ]);
        }
    }
}
