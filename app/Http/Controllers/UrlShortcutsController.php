<?php

namespace App\Http\Controllers;

use App\Models\url_shortcuts;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class UrlShortcutsController extends Controller
{
    public function index()
    {
        $settings = url_shortcuts::all();
        return response()->json([
            'status' => true,
            'message' => 'Data retrieved successfully',
            'data' => $settings
        ], 200);
    }

    public function show($id)
    {
        $settings = url_shortcuts::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Data founded successfully',
            'data' => $settings
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'url' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $settings = url_shortcuts::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Data created successfully',
            'data' => $settings
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'url' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $settings = url_shortcuts::findOrFail($id);
        $settings->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data updated successfully',
            'data' => $settings
        ], 200);
    }

    public function destroy($id)
    {
        $settings = url_shortcuts::findOrFail($id);
        $settings->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data deleted successfully'
        ], 204);
    }
}
