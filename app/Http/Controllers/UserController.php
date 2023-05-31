<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Models\Matter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic;

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
    public function store(UserRequest $request)
    {
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
        $head = $this->seo->render(
            env('APP_NAME') . ' | Usuário - ' . $user->name,
            'Bem vindo ao fórum do curso de Ciência da Computação!',
            route('users.show', ['user' => $user->id]),
            ''
        );

        return view('users.show', [
            'head' => $head,
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

        $head = $this->seo->render(
            env('APP_NAME') . ' | Usuário - Configurações',
            'Bem vindo ao fórum do curso de Ciência da Computação!',
            route('users.edit', ['user' => $user->id]),
            ''
        );

        return view('users.edit', [
            'head' => $head,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        if (auth()->id() !== $user->id) {
            return back();
        }

        $user->fill($request->only('name', 'period', 'shift'));
        if ($request->password) $user->password = Hash::make($request->password);

        if ($request->avatar) {
            $cachePath = $request->file('avatar')->store('cache');
            $hashName = $request->file('avatar')->hashName();

            $image = ImageManagerStatic::make(public_path('storage/' . $cachePath));
            $image->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save(public_path('storage/' . 'avatars/' . $hashName));

            $user->avatar = 'avatars/' . $hashName;
        }

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
