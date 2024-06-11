<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sustampu:make-admin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make user Admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::where('email', $this->argument('email'));
        if(!$user){
            $this->fail('something went wrong');
            return;
        }
        $user->update([
            'is_admin'=>true,
        ]);
        $this->info(('L\'utente {$user->name} è ora Amministratore' ));

        
    }
}
