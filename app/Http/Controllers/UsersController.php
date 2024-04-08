<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->users = new Users;
    }
    private $users;
    public function index()
    {
        $users = $this->users->getAllUser();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataInsert = [
            'name' => $request->name,
            'email' =>$request->email,
            'password' =>$request->password,
        ];
        $this->users->createUser($dataInsert);
        return response()->json(['message' => 'User created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        try {
            $user = $this->users->getOneUser($id);
            return response()->json(['user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = $this->users->getOneUser($id);
        $dataUpdate = [
            'name' => $request->name,
            'email' =>$request->email,
            'password' =>$request->password,
        ];
        if (!$post) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $this->users->updateUser($dataUpdate, $id);
        return response()->json(['message' => 'User updated successfully'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->users->getOneUser($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $this->users->deleteUser($id);
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
