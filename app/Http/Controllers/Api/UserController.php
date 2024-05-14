<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // return User::latest()->paginate(10);
        // return UserResource::collection(User::latest()->paginate(10));
        return new UserCollection(User::orderBy('id', 'DESC')->paginate(10));
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8|max:20',
            'phone' => 'required|numeric',
            'address' => 'required',
            'total' => 'required',
        ]);
        

        // Check if validation fails
        if ($validator->fails()) {
            // If validation fails, return validation errors as JSON response
            // return response()->json(['errors' => $validator->errors()], 422);
            return response()->json([
                'status' => 'validation_error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;        
        $user->password = Hash::make($request->password) ?? Hash::make('12345678');
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->total= $request->total;
        $user->save();
        return new UserResource($user);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        return new UserResource(User::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,            
            'phone' => 'required|numeric',
            'address' => 'required',
            'total' => 'required',
        ]);
        
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->total= $request->total;
        $user->save();
        return new UserResource($user);
    }


    public function search($field, $query) {
        return new UserCollection(User::where($field, 'LIKE', '%' . $query . '%')->latest()->paginate(10)) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {

        $user = User::findOrFail($id);
        $user->delete();
        return new UserResource($user);
        
    }

}
