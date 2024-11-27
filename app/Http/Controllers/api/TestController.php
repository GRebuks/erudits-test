<?php

namespace App\Http\Controllers\api;

use App\Events\StartGameEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
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

    public function store(TestRequest $request) {
        $validated = $request->validated();

        $test = new Test($validated);
        $test->save();

        return $test;
    }

    public function update(TestRequest $request, Test $test) {
        $validated = $request->validated();

        $test->update($validated);
        return $test;
    }

    public function delete(Test $test) {
        $test->delete();
        return response()->json(null, 204);
    }

    public function startTest(Test $test) {
        $test->update(['active' => true]);
        event(new StartGameEvent($test->id));
        return $test;
    }
}
