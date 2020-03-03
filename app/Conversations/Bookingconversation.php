<?php

namespace App\Conversations;

use Carbon\Carbon;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class BookingConversation extends Conversation
{
    public function askQty()
    {
        $question = Question::create('Select Qty')
            ->callbackId('select_qty')
            ->addButtons([
                Button::create('50')->value('50'),
                Button::create('100')->value('100'),
                Button::create('500')->value('500'),
            ]);

        $this->ask($question, function(Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'timeSlot' => $answer->getValue(),
                ]);
            $this->askAddress();
        }
        });
    }
        public function askAddress()
    {
        $this->ask('What is your Postal Address', function(Answer $answer) {
            $this->bot->userStorage()->save([
                'Address' => $answer->getText(),
            ]);

            $this->say('Thanks for the address');
            $this->bot->startConversation(new ReceiptConversation());
             });
    }

    public function run()
    {
        $this->askQty();
    }

}
