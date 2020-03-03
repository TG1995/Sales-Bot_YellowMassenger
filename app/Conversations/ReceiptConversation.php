<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class ReceiptConversation extends Conversation
{
    public function confirmBooking()
    {
        $user = $this->bot->userStorage()->find();

        $message = ($user->get('name'));
       

        $this->say('Thanks ' . $message .' Your booking has been confirmed. Please Proceed with payment ');
    }

    public function run()
    {
        $this->confirmBooking();
    }
}