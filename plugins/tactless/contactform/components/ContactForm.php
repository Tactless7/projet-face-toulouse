<?php

namespace Tactless\Contactform\Components;

use Cms\Classes\ComponentBase;

class ContactForm extends ComponentBase {

    public function componentDetails(){
        return [
            'name' => 'Contact Form',
            'description' => 'A simple contact form',
        ];
    }

    public function onSend(){
        $vars = ['name' => Input::get('name'), 'email' => Input::get('email')];

        Mail::send('acme.blog::mail.message', $vars, function($message) {
            $message->to('admin@domain.tld', 'FACE Toulouse');
            $message->subject('Nouveau message du formulaire de contact');

});
    }

}
