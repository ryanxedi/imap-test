<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Webklex\PHPIMAP\ClientManager;
use Webklex\PHPIMAP\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use App\Models\Account;

trait TestTrait {

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
        sleep(5);
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
        $inboxFolder = $client->getFolder('INBOX');

        $messages = $inboxFolder->messages()->all();

        $search = $inboxFolder->search()->subject($subject)->get();

        if (count($search)) {
            $client->disconnect();
            return true;
        }


        $client->disconnect();
        return false;
    }

}