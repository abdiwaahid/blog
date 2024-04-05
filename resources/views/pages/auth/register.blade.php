<?php

use App\Models\User;
use Illuminate\Auth\Events\Login;
use function Laravel\Folio\{middleware, name};
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

middleware(['guest']);
name('login');

new class extends Component {
    #[Validate('required|email')]
    public $email = '';

    #[Validate('required')]
    public $password = '';

    public $remember = false;

    public function authenticate()
    {
        $this->validate();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', trans('auth.failed'));

            return;
        }

        event(new Login(auth()->guard('web'), User::where('email', $this->email)->first(), $this->remember));

        return redirect()->intended('/');
    }
};

?>

<x-layout>
    <x-card class="w-1/2 h-1/2 m-auto mt-20">
        <h4 class="text-lg text-center space-y-4">Welocme again :)</h4>
        @volt('auth.login')
            <form action="" class="w-full">
                <x-form.input type='name' placeholder="Enter name" name="name"></x-form.input>
                <x-form.input type='email' placeholder="Enter Email" name="email"></x-form.input>

                <x-form.input type='password' placeholder="Enter password" name="password"></x-form.input>
                <x-form.input type='confirm_password' placeholder="Enter Password again"
                    name="confirm_password"></x-form.input>

                <x-button.primary class="w-full mt-3">Sign Up</x-button.primary>

                <hr class="hr mt-5 mb-3">

                <p class="text-center mt-3">Already have an account? <a class="text-bold text-blue-600"
                        href="{{ url('auth/login') }}">Sign in</a></p>

            </form>
        @endvolt
    </x-card>
</x-layout>
