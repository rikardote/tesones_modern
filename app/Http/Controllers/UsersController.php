<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserInfoRequest;
use App\Models\User;
use App\Services\TesonService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class UsersController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
        private readonly TesonService $tesonService,
    ) {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('users.index', [
            'user' => auth()->user(),
        ]);
    }

    public function update(UpdateUserInfoRequest $request): RedirectResponse
    {
        $this->userService->updateInfo(auth()->user(), $request->validated());

        return redirect()->route('usuarios.index');
    }

    public function editAdmin(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function updateAdmin(UpdateUserInfoRequest $request, User $user): RedirectResponse
    {
        $this->userService->updateInfo($user, $request->validated());

        return redirect()->route('admin.users_all.index');
    }

    public function usersAll(): View
    {
        return view('users.index_all', [
            'users' => $this->userService->allOrderedByAdscripcion(),
        ]);
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function editPassword(User $user): View
    {
        return view('users.edit_password', compact('user'));
    }

    public function updatePassword(UpdatePasswordRequest $request, User $user): RedirectResponse
    {
        $this->userService->updatePassword($user, $request->validated()['password']);

        return redirect()->route('admin.users_all.index');
    }

    public function borrar(User $user): RedirectResponse
    {
        $this->userService->delete($user);

        return redirect()->route('admin.users_all.index');
    }

    public function verPorUsuario(User $user): View
    {
        $tesones = $this->tesonService->listForUserView($user->id);

        return view('tesones.ver_por_usuario', compact('tesones', 'user'));
    }
}
