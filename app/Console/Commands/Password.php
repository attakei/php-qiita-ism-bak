<?php

namespace App\Console\Commands;

use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Process\ProcessUtils;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\PhpExecutableFinder;

class Password extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset user password';

    /**
     * Execute the console command.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function fire() {
        $email = $this->input->getOption('email');
        $password = $this->input->getOption('password');

        // Find target user
        $user = User::where('email', $email)->first();
        if ( is_null($user) ) {
            throw new Exception("Email '{$email}' is not found.");
        }
        // Reset password
        $user->password = password_hash($password, PASSWORD_BCRYPT);
        $user->save();
        return;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return [
            ['email', null, InputOption::VALUE_REQUIRED, 'User email',],
            ['password', null, InputOption::VALUE_REQUIRED, 'New password'],
        ];
    }

}
