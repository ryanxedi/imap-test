<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Webklex\PHPIMAP\ClientManager;
use Webklex\PHPIMAP\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use App\Models\Account;

class TestConnection extends Component
{
    public $account_id;
    public $account;
    public $subject;

    public function test()
    {
        $account = Account::find($this->account_id);
        $subject = Str::uuid()->toString();

        $send = $this->sendEmail($account, $subject);

        if ($send->statusText() == 'OK') {
            $check = $this->checkEmail($account, $subject);
            
            if ($check == true) {
                session()->flash('success', 'Message sent successfully and confirmed delivery');
                return redirect()->to('/accounts');
            } else {
                session()->flash('failure', 'Message sent but not confirmed');
                return redirect()->to('/accounts');
            }
        } else {
            session()->flash('failure', 'Message failed to send');
            return redirect()->to('/accounts');
        }
    }

    public function sendEmail($account, $subject)
    {
        $senderAddress = $account->outgoing_username;
        $senderName = $account->label;
        $recipientAddress = $account->incoming_username;
        $content = 'Test email';

        $email = new Email();
        $email->from(new Address($senderAddress, $senderName))
            ->to($recipientAddress)
            ->subject($subject)
            ->text($content);

        // Configure the SMTP settings
        $smtpServer = $account->outgoing_server;
        $smtpPort = $account->outgoing_port;
        $smtpUsername = $account->outgoing_username;
        $smtpPassword = $account->outgoing_password;

        config([
            'mail.mailers.smtp.host' => $smtpServer,
            'mail.mailers.smtp.port' => $smtpPort,
            'mail.mailers.smtp.username' => $smtpUsername,
            'mail.mailers.smtp.password' => $smtpPassword,
            'mail.from.address' => $senderAddress,
            'mail.from.name' => $senderName,
        ]);

        $data = [
            'subject' => $subject,
        ];

        $sent = Mail::send('emails.test_email', $data, function ($message) use ($senderAddress, $senderName, $recipientAddress, $subject) {
            $message->from($senderAddress, $senderName)
                ->to($recipientAddress)
                ->subject($subject);
        });

        // Check if the email was sent successfully
        if ($sent) {
            // Email sent successfully
            return response()->json(['message' => 'Email sent successfully'], 200);
        } else {
            // Email sending failed
            return response()->json(['message' => 'Failed to send email'], 500);
        }
    }

    public function checkEmail($account, $subject)
    {
        sleep(3);
        $clientManager = new ClientManager($options = []);
        $client = $clientManager->make([
            'host'          => $account->incoming_server,
            'port'          => $account->incoming_port,
            'encryption'    => $account->incoming_security,
            'validate_cert' => true,
            'username'      => $account->incoming_username,
            'password'      => $account->incoming_password,
            'protocol'      => 'imap'
        ]);

        $client->connect();

        $search = $client->getFolder('INBOX')->search()->subject($subject)->get();

        if (count($search)) {
            $client->disconnect();
            return true;
        }

        $client->disconnect();
        return false;
    }

    public function render()
    {
        return view('livewire.test-connection');
    }
}
