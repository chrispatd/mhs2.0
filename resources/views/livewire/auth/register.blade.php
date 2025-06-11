<?php

use App\Models\MsUser;
use App\Models\MsEmployee;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;  
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name                  = '';
    public string $email                 = '';
    public string $password              = '';
    public string $password_confirmation = '';
    public string $teacher_code          = '';  // NIP/NIY

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        // 1. Validasi input
        $validated = $this->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:ms_user,email'],
            'password'              => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'teacher_code' => [
            'required', 'string',
            // harus unik di ms_user.teacher_code
            Rule::unique('ms_user', 'teacher_code'),
            // dan juga harus ada di ms_employee.teacher_code
            function($attr, $value, $fail) {
                if (! MsEmployee::where('teacher_code', $value)->exists()) {
                    $fail("NIP/NIY “{$value}” not registered as an employee.");
                }
            },
        ],
        ]);

        // 2. Hash password
        $validated['password'] = Hash::make($validated['password']);

        // 3. Buat user di tabel ms_user
        $user = MsUser::create([
            'role_id'               => null,
            'role_access_id'        => null,
            'employee_id'           => null,
            'teacher_code'          => $validated['teacher_code'],
            'code_type'             => null,
            'is_homeroomteacher'    => false,
            'is_super_user'         => false,
            'is_score_spiritual'    => false,
            'is_score_sosial'       => false,
            'ppdb_access'           => null,
            'email'                 => $validated['email'],
            'username'              => $validated['email'], // atau nama lain
            'password'              => $validated['password'],
            'active_semester_id'    => null,
            'active_school_year_id' => null,
            'remember_token'        => null,
        ]);

        // 4. Event & login
        event(new Registered($user));
        Auth::login($user);

        // 5. Redirect ke dashboard
        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header
        :title="__('Create an account')"
        :description="__('Enter your details below to create your account')"
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Full name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            placeholder="John Doe"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- NIP / NIY -->
        <flux:input
            wire:model="teacher_code"
            :label="__('NIP / NIY')"
            type="text"
            required
            placeholder="Contoh: 12345678"
        />
       
        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="new-password"
            viewable
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirm password')"
            type="password"
            required
            autocomplete="new-password"
            viewable
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
