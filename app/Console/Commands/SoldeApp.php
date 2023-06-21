<?php

namespace App\Console\Commands;

use App\Models\Client;
use Bavix\Wallet\Models\Wallet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SoldeApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'solde:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ckecking apps solde';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $kabids = Client::all();
        $i=0;
        foreach ($kabids as $kabid) {
            $rsolde = $kabid->transactions()->sum('amount');
            
            if ($rsolde <> $kabid->balance) {
                $wallet = Wallet::where('holder_type',Client::class)->where('holder_id',$kabid->id)->first();
                $wallet->balance = $rsolde;
                $wallet->save();
                $i=$i+1;
            }
        }
        $email_data = array(
            'name' =>  config('etus.server.name'),
            'email' =>  'nouariaissa44@gmail.com',
            'pin'=>  $i,
            'srvname'=>config('etus.server.name')
        );
      Mail::send('emails.cron', $email_data, function ($message) use ($email_data) {
            $message->to($email_data['email'], $email_data['name'])
                ->subject('Cron Joub APP ')
                ->from('contact@deeperTech.dz', $email_data['srvname']);
        });
        $this->info('Solde Apps updated successfully '.$i);
    }
}
