<?php

namespace Modules\Donations\Console;

use Illuminate\Console\Command;
use Modules\Donations\Entities\RecurringDonation;
use Modules\Transaction\Services\MyFatoorahRecurringPaymentService;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DeleteAllRecurringCommand extends Command
{
    protected $payment;


    protected $signature = 'delete:recurring';


    protected $description = 'Command description';


    public function __construct( )
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

        try {
            $recurrings = RecurringDonation::
            whereNotNUll('RecurringId')->
            get();

            foreach ($recurrings as $item){

                $this->payment->delete($item);
            }


            $this->info(count($recurrings) . '  orders deleted.');
        }catch (\Exception $exception){
            $this->error('An error occurred: ' . $exception->getMessage());
            \Log::error($exception);
        }

        //
    }

}
