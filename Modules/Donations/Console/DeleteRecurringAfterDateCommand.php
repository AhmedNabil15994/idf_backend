<?php

namespace Modules\Donations\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Modules\Donations\Entities\RecurringDonation;
use Modules\Transaction\Services\MyFatoorahRecurringPaymentService;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DeleteRecurringAfterDateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'delete:afterdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete All Recurring After Nex Date ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $payment;
    public function __construct()
    {
        parent::__construct();
        $this->payment = new MyFatoorahRecurringPaymentService;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

        try {
            $recurrings = RecurringDonation::

            where('end_at' , '<=' , Carbon::today())->
            whereNotNUll('RecurringId')->
            get();

           foreach ($recurrings as $item){

                $this->payment->cancel($item);
            }


            $this->info(count($recurrings) . '  orders deleted.');
        }catch (\Exception $exception){
            $this->error('An error occurred: ' . $exception->getMessage());
            \Log::error($exception);
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
