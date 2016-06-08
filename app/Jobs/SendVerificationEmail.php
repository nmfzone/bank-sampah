<?php

namespace App\Jobs;

use App\User;
use Site;
use App\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerificationEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;

    protected $verificationLink;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $verificationLink)
    {
        $this->user = $user;
        $this->verificationLink = $verificationLink;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->send('emails.verification', ['user' => $this->user, 'link' => $this->verificationLink], function ($message) {
            $message->to($this->user->email, $this->user->name)->subject(Site::get('site_name') . ": Emails Verification");
        });
    }
}
