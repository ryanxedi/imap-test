<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Webklex\PHPIMAP\ClientManager;
use Webklex\PHPIMAP\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();

        return view('accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'incoming_server' => 'required',
            'incoming_username' => 'required',
            'incoming_password' => 'required',
            'incoming_port' => 'required',
            'incoming_security' => 'required',
            'outgoing_server' => 'required',
            'outgoing_username' => 'required',
            'outgoing_password' => 'required',
            'outgoing_port' => 'required',
            'outgoing_security' => 'required',
        ]);

        Account::create($request->all());

        return redirect('/accounts')->with('success', 'Created successfully');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        return view('accounts.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $account->update($request->all());

        return redirect('/accounts')->with('success', 'Updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return back()->with('success', 'Deleted successfully');
    }

    public function test(Account $account)
    {
        // Send an email with a unique subject line
        $subject = Str::uuid()->toString();
        $send = $this->sendEmail($account, $subject);


        if ($send->statusText() == 'OK') {
            return back()->with('success', 'Message sent successfully');
        } else {
            return back()->with('failure', 'Message failed to send');
        }

        // Check the inbox for that message
        $cm = new ClientManager($options = []);
        $client = $cm->make([
            'host'          => $account->incoming_server,
            'port'          => $account->incoming_port,
            'encryption'    => $account->incoming_security,
            'validate_cert' => true,
            'username'      => $account->incoming_username,
            'password'      => $account->incoming_password,
            'protocol'      => 'imap'
        ]);

        $client->connect();

        $folders = $client->getFolders();

        foreach($folders as $folder){
            $email = [];
            //Get all Messages of the current Mailbox $folder
            /** @var \Webklex\PHPIMAP\Support\MessageCollection $messages */

            $messages = $client->getFolderByPath('INBOX');

            dd($messages);
            /** @var \Webklex\PHPIMAP\Message $message */
            foreach ($messages as $message) {
                dd($message);
                dd($message->getSubject(), $message->getHTMLBody());
            }
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
}
