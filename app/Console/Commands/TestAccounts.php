<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Traits\TestTrait;
use App\Models\Account;
use Illuminate\Support\Str;
use App\Mail\DailyReport;
use Mail;

class TestAccounts extends Command
{
    use TestTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $accounts = Account::all();
        $passed = [];
        $failed = [];

        foreach ($accounts as $account) {
            $subject = Str::uuid()->toString();
            $send = $this->sendEmail($account, $subject);

            if ($send->statusText() == 'OK') {
                $check = $this->checkEmail($account, $subject);
                
                if ($check == true) {
                    $message = $account->outgoing_username . ' - Message sent successfully and confirmed delivery';
                    
                    $passed[] = $message;
                    
                    $this->info($message);
                } else {
                    $message = $account->outgoing_username . ' - Message sent but not confirmed';
                    
                    $failed[] = $message;

                    $this->error($message);
                }
            } else {
                $message = $account->outgoing_username . 'Message failed to send';

                $failed[] = $message;

                $this->error($message);
            }
        }

        // Send email with passed and failed arrays
        Mail::to(env('MAIL_USERNAME'))
            ->send(new DailyReport($passed, $failed));
    }
}
