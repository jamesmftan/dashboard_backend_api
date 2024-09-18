<?php

namespace App\Http\Controllers;

use App\Models\todos;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class TodosController extends Controller
{
    public function index()
    {
        $todos = Todos::all();
        return response()->json([
            'status' => true,
            'message' => 'Customers retrieved successfully',
            'data' => $todos
        ], 200);
    }

    public function show($id)
    {
        $todos = Todos::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Data founded successfully',
            'data' => $todos
        ], 200);
    }

    public function store(Request $request)
    {
        $date = Carbon::parse($request->input('date'));
        $day = $date->format('l');
        $request->merge(['day' => $day]);

        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'day' => 'required|string',
            'time' => 'required|date_format:H:i:s',
            'activity' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $todos = Todos::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Data created successfully',
            'data' => $todos
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $date = Carbon::parse($request->input('date'));
        $day = $date->format('l');
        $request->merge(['day' => $day]);

        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'day' => 'required|string',
            'time' => 'required|date_format:H:i:s',
            'activity' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $todos = Todos::findOrFail($id);
        $todos->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data updated successfully',
            'data' => $todos
        ], 200);
    }

    public function destroy($id)
    {
        $todos = Todos::findOrFail($id);
        $todos->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data deleted successfully'
        ], 204);
    }
}
