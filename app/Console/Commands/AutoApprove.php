<?php

namespace App\Console\Commands;


use DB;
use Illuminate\Console\Command;

class AutoApprove extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AutoApprove:autoapproveclaims';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Approve Claims';

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
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
