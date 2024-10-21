<?php

namespace App\Jobs;

use App\Mail\SendMail;
use App\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class SendSaleEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public Customer $customer;
    public $orderDetails;
    public function __construct(
        Customer $customer
        , $orderDetails
    )
    {
        $this->customer = $customer;
        $this->orderDetails = $orderDetails;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        \Log::info('Enviando email para: ' . $this->customer->email);
        \Log::info('Detalhes do pedido: ', (array)$this->orderDetails);
        Mail::to($this->customer->email)->send(new SendMail(
            $this->customer
            , $this->orderDetails
        ));
    }
}
