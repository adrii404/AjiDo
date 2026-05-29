<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectRoute('login');
    }
}; ?>

<div class="min-h-screen relative overflow-hidden flex items-center justify-center bg-[#0f172a] px-4">

    <!-- ambient background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-32 -left-24 w-[420px] h-[420px] bg-pink-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -right-20 w-[500px] h-[500px] bg-fuchsia-500/10 rounded-full blur-3xl"></div>
    </div>

    <!-- subtle grid -->
    <div
        class="absolute inset-0 opacity-[0.03]"
        style="
            background-image:
                linear-gradient(to right, white 1px, transparent 1px),
                linear-gradient(to bottom, white 1px, transparent 1px);
            background-size: 42px 42px;
        "
    ></div>

    <!-- login card -->
    <div class="relative w-full max-w-md">

        <div class="rounded-[30px] border border-white/10 bg-white/[0.04] backdrop-blur-2xl shadow-2xl p-8">

            <!-- Header -->
            <div class="text-center mb-8">

                <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-br from-pink-500 to-rose-400 flex items-center justify-center shadow-lg shadow-pink-500/20 mb-5">
                    <span class="text-2xl text-white">♡</span>
                </div>

                <h1 class="text-3xl font-semibold tracking-tight text-white">
                    Welcome back
                </h1>

                <p class="text-white/50 mt-2 text-sm">
                    Organize your tasks and plans beautifully.
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status
                class="mb-4 text-sm text-pink-300"
                :status="session('status')"
            />

            <form wire:submit="login" class="space-y-5">

                <!-- Email -->
                <div>
                    <x-input-label
                        for="email"
                        :value="__('Email')"
                        class="text-white/60 mb-2"
                    />

                    <x-text-input
                        wire:model="form.email"
                        id="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="hello@example.com"
                        class="w-full rounded-2xl border border-white/10 bg-white/[0.03] px-4 py-3 text-white placeholder:text-white/25 focus:border-pink-400 focus:ring focus:ring-pink-400/20"
                    />

                    <x-input-error
                        :messages="$errors->get('form.email')"
                        class="mt-2 text-rose-300"
                    />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label
                        for="password"
                        :value="__('Password')"
                        class="text-white/60 mb-2"
                    />

                    <x-text-input
                        wire:model="form.password"
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full rounded-2xl border border-white/10 bg-white/[0.03] px-4 py-3 text-white placeholder:text-white/25 focus:border-pink-400 focus:ring focus:ring-pink-400/20"
                    />

                    <x-input-error
                        :messages="$errors->get('form.password')"
                        class="mt-2 text-rose-300"
                    />
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between text-sm">

                    <label for="remember" class="inline-flex items-center gap-2 text-white/50">
                        <input
                            wire:model="form.remember"
                            id="remember"
                            type="checkbox"
                            name="remember"
                            class="rounded border-white/20 bg-transparent text-pink-500 focus:ring-pink-400"
                        >

                        <span>Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a
                            href="{{ route('password.request') }}"
                            wire:navigate
                            class="text-pink-300 hover:text-pink-200 transition"
                        >
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Button -->
                <button
                    type="submit"
                    class="w-full py-3 rounded-2xl bg-gradient-to-r from-pink-500 to-rose-400 text-white font-semibold shadow-lg shadow-pink-500/20 hover:opacity-90 transition-all duration-300"
                >
                    Log In
                </button>
            </form>
        </div>
    </div>
</div>