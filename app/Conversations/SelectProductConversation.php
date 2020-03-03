<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class SelectProductConversation extends Conversation
{
    public function askproduct()
    {
        $question = Question::create('What Product you are looking for?')
            ->callbackId('select_product')
            ->addButtons([
                Button::create('Vegan Grilled Chicken')->value('Grilled'),
                Button::create('Vegan Cicken Ham')->value('Ham'),
                Button::create('Vegan Chicken Peri Peri')->value('Peri'),
            ]);

        $this->ask($question, function(Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->bot->userStorage()->save([
                    'product' => $answer->getValue(),
                ]);
            }
            $this->say('Ok!');
            $this->bot->startConversation(new BookingConversation());
        });
    }

    public function run()
    {
        $this->askproduct();

    }
}