<?php namespace Tactless\Contactform;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
      return [
        'Tactless\Contactform\Components\ContactForm' => 'contactform',
      ];
    }

    public function registerSettings()
    {
    }
}
