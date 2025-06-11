<?php

use App\Models\MsUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public string $username = '';
    public string $email    = '';

    public function mount(): void
    {
        $this->username = Auth::user()->username;
        $this->email    = Auth::user()->email;
    }

    public function updateProfileInformation(): void
    {
        /** @var MsUser $user */
        $user = Auth::user();

        $validated = $this->validate([
            'username' => ['required', 'string', 'max:100',
                Rule::unique(MsUser::class, 'username')
                    ->ignore($user->user_id, 'user_id'),
            ],
            'email'    => ['required','string','email','max:100',
                Rule::unique(MsUser::class, 'email')
                    ->ignore($user->user_id, 'user_id'),
            ],
        ]);

        // update username & email di ms_user
        $user->fill([
            'username' => $validated['username'],
            'email'    => $validated['email'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        session()->flash('status', 'profile-updated');

        // --- TAMBAHKAN BARIS INI agar halaman reload penuh ---
        $this->redirectRoute('settings.profile');
    }

    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your username and email address')">
        <form wire:submit.prevent="updateProfileInformation" class="my-6 w-full space-y-6">
            <!-- Username sebagai 'nama' -->
            <flux:input
                wire:model="username"
                :label="__('Username')"
                type="text"
                required
                autofocus
                autocomplete="username"
            />

            <!-- Email -->
            <flux:input
                wire:model="email"
                :label="__('Email')"
                type="email"
                required
                autocomplete="email"
            />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <flux:text class="mt-4">
                        {{ __('Your email address is unverified.') }}
                        <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                            {{ __('Click here to re-send the verification email.') }}
                        </flux:link>
                    </flux:text>
                    @if (session('status') === 'verification-link-sent')
                        <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </flux:text>
                    @endif
                </div>
            @endif

            <div class="flex items-center gap-4">
                <flux:button variant="primary" type="submit" class="w-full">
                    {{ __('Save') }}
                </flux:button>
                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
