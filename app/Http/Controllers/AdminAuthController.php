<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AdminAuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    public function create(): RedirectResponse|Response
    {
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.products.index');
        }

        return Inertia::render('Admin/Auth/Login');
    }

    public function store(AdminLoginRequest $request): RedirectResponse
    {
        $this->authService->login($request->validated(), $request);

        return redirect()->intended(route('admin.products.index'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        $this->authService->logout($request);

        return redirect()->route('admin.login');
    }
}
