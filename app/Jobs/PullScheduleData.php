<?php

namespace App\Jobs;

use App\Models\SomTodayiCalAccount;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Sabre\VObject\Reader as Calendar;

class PullScheduleData implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The account instance.
     *
     * @var \App\Models\SomTodayiCalAccount
     */
    public $account;

    /**
     * The number of seconds after which the job's unique lock will be released.
     *
     * @var int
     */
    public $uniqueFor = 3600;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SomTodayiCalAccount $account)
    {
        $this->account = $account->withoutRelations();
    }

    public function uniqueId()
    {
        return $this->account->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $vcalendar = Calendar::read(
            file_get_contents($this->account->ical_url)
        );
    }
}
