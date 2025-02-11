<?php

namespace App\Livewire;

use Livewire\Component;

class NewToken extends Component
{
    public $user;

    public $plainTextToken = '';

    public function newToken()
    {
        $token = $this->user->createToken('api_token');

        $this->plainTextToken = $token->plainTextToken;
    }

    public function render()
    {
        $plainTextToken = $this->plainTextToken;

        return view('livewire.new-token', compact('plainTextToken'));
    }
}
