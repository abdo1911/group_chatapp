<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\User;
use http\Url;
use Livewire\Component;

class Chat extends Component
{
    public $messageText;

    protected $rules = [
        'messageText' => 'required',
    ];

    public function render()
    {
        $slugs = explode ("/", \url()->current());
        $latestslug = $slugs [(count ($slugs) - 1)];
        $messages = Message::with('user')->latest()->take(10)->get()->sortBy('id');
        return view('livewire.chat', compact('messages','latestslug'));
    }

    public function sendMessage()
    {
        $this->validate();
        Message::create([
            'user_id' => auth()->user()->id,
            'message_text' => $this->messageText,
        ]);

        $this->reset('messageText');
    }


}
