<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Support\Facades\Request;

class TestController extends Controller
{
    public function index() {
        return Test::all();
    }

    public function show(Test $test) {
        return $test;
    }

    public function create(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'nullable|boolean',
        ]);

        return new Test($validated);
    }

    public function update(Request $request, Test $test) {
        $validated = $request->validate([
            'name' => 'required|string',
            'status' => 'nullable|boolean',
        ]);

        $test->update($validated);
        return $test;
    }

    public function delete(Test $test) {
        $test->delete();
        return response()->json(null, 204);
    }
}
