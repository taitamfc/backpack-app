<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SyncSiteJobsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $web_hook = '';
    private $sync_type = '';
    private $site = '';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($site,$sync_type,$web_hook)
    {
        $this->site = $site;
        $this->web_hook = $web_hook;
        $this->sync_type = $sync_type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('['.$this->site->site_domain.'] - ['.$this->sync_type.']: Start sync');
        $response = Http::get($this->web_hook.$this->sync_type);
        Log::info('['.$this->site->site_domain.'] - ['.$this->sync_type.']: Stop sync: '.json_encode($response->json()));
    }
}
