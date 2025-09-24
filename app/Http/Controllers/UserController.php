<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.author.index', [
          'authors' => User::where('role', 'author')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('back.author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
      $validated = $request->validated();
      $validated['password'] = Hash::make('12345678');

      User::create($validated);

      return redirect()->route('author.index')->with('success', 'Auteur ajouté avec succès 🤩');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
