<?php

namespace App\Http\Controllers;

use App\Models\settings;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::all();
        return response()->json([
            'status' => true,
            'message' => 'Data retrieved successfully',
            'data' => $settings
        ], 200);
    }

    public function show($id)
    {
        $settings = Settings::findOrFail($id);
        return response()->json([
            'status' => true,
            'message' => 'Data founded successfully',
            'data' => $settings
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'background_image' => 'required|string',
            'background_intensity' => 'required|integer',
            'theme' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $settings = Settings::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Data created successfully',
            'data' => $settings
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'background_image' => 'required|string',
            'background_intensity' => 'required|integer',
            'theme' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $settings = Settings::findOrFail($id);
        $settings->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data updated successfully',
            'data' => $settings
        ], 200);
    }

    public function destroy($id)
    {
        $settings = Settings::findOrFail($id);
        $settings->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data deleted successfully'
        ], 204);
    }
}
