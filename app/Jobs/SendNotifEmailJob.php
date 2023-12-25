<?php

namespace App\Jobs;

use App\Mail\OrderShipped;
use App\Models\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class SendNotifEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public function __construct(
        public string $email,
        public string $name,
        public $created_at,
        public $id
    )
    {
        //
    }
    public function handle()
    {
        Mail::to($this->email)->send(new OrderShipped($this->name, $this->created_at, $this->id));
    }
}
