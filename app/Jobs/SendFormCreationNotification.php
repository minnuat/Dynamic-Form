<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Form;

class SendFormCreationNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $form;

    /**
     * Create a new job instance.
     */
    public function __construct(Form $form)
    {
        $this->form = $form;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        // $email = 'admin@a.com'; 
        $email  = 'minnu.tolstoy@gmail.com'; 

        $subject = 'New Form Created';
        $message = 'A new form has been successfully created: ' . $this->form->form_name;

        Mail::to($email)->send(new \App\Mail\FormCreationNotification($subject, $message));
    }
}
