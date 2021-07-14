<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WishListMailer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $url = '';
    public $game = '';
    public function __construct($url, $game)
    {
        $this->url = $url;
        $this->game = $game;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = '';
        $game = '';
        return $this->subject('The game '. ucfirst($game) .' on your wishlist has a new listing')->markdown('email.wishlist', compact('url', 'game'));
    }
}
