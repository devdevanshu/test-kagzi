<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Purchase;
use App\Models\User;

class PurchaseConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $purchase;
    public $user;
    public $product;
    public $pricing;

    /**
     * Create a new message instance.
     */
    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
        $this->user = $purchase->user;
        $this->product = $purchase->product;
        $this->pricing = $purchase->pricing;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Purchase Confirmation - Kagzi')
                    ->view('emails.purchase-confirmation')
                    ->with([
                        'purchase' => $this->purchase,
                        'user' => $this->user,
                        'product' => $this->product,
                        'pricing' => $this->pricing,
                        'userDisplayId' => $this->user ? $this->user->display_user_id : 'Guest-' . $this->purchase->id,
                    ]);
    }
}
