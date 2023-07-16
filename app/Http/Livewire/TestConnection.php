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
use Exception;
use App\Mail\FailedTest;
use App\Traits\TestTrait;

class TestConnection extends Component
{
    use TestTrait;

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
                session()->flash('success', 'Message sent and confirmed delivery');
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

    public function render()
    {
        return view('livewire.test-connection');
    }
}
