<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class editbasic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:editbasic';

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
        User::where('edit_basic',1)->where('edit_basic_endtime','!=',NULL)->where('edit_basic_endtime','<',Carbon::now())->update([
            'edit_basic_endtime'=>NULL,
            'edit_basic'=>0,
        ]);

        User::where('edit_additional',1)->where('edit_additional_endtime','!=',NULL)->where('edit_additional_endtime','<',Carbon::now())->update([
            'edit_additional_endtime'=>NULL,
            'edit_additional'=>0,
        ]);
    }
}
