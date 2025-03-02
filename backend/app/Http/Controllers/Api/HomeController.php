<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        try {

            if (Auth::check()) {
                $user = Auth::user();
                dd($user);


                if ($user->hasRole('admin')) {
                    return response()->json([
                        'message' => 'Welcome Admin',
                        'user' => $user
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Unauthorized: You are not an admin'
                    ], 403);
                }
            } else {
                return response()->json([
                    'message' => 'Unauthorized: Please log in'
                ], 401);
            }
        } catch (\Exception $e) {

            Log::error('Error in HomeController@index: ' . $e->getMessage());

            return response()->json([
                'message' => 'An error occurred. Please try again later.'
            ], 500);
        }
    }

   
}
