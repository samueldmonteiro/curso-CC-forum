<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Matter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('users.show', ['user' => auth()->id()]);
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
        if (in_array('', $request->all()) || !is_email($request->email)) {
            return message()->error('Preencha todos os campos corretamente!')->status(false)->json();
        }

        if ($request->password !== $request->confirm_password) {
            return message()->error('As senhas devem ser correspondentes!')->status(false)->json();
        }

        $user = User::make($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        auth()->login($user);
        return message()->success('Conta criada com sucesso')
            ->status(true)->more(['redirect' => route('home')])->json();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (auth()->id() !== $user->id) {
            return redirect()->back();
        }

        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (auth()->id() !== $user->id) {
            return back();
        }

        $validated = $request->validate([
            'name' => 'required|min:5|max:30',
            //'email' => 'email|required|unique:users',
            'period' => 'required|integer',
            'shift' => 'required',
            'password' => 'nullable|min:8',
            'confirm_password' => 'nullable|min:8|same:password'
        ]);

        if (!in_array($request->period, [1, 2, 3, 4, 5])) {
            return back()->withErrors(['period' => 'Preecha o campo de período corretamente']);
        }

        if (!in_array($request->shift, ['Matutino', 'Vespertino', 'Noturno'])) {
            return back()->withErrors(['period' => 'Preecha o campo de turno corretamente']);
        }

        $user->fill($request->only('name', 'period', 'shift'));
        if ($request->password) $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('message', 'Dados atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
