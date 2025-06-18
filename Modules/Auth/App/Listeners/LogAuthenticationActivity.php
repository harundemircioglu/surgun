<?php

namespace Modules\Auth\App\Listeners;

use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Request;
use Modules\Auth\App\Models\AuthenticationActivity;

class LogAuthenticationActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        $user = $event->user ?? null;

        AuthenticationActivity::create([
            'user_id' => $user?->id,
            'activity_type' => $this->getType($event),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'is_successful' => $event instanceof Failed ? false : true,
        ]);
    }

    protected function getType($event): string
    {
        return match (true) {
            $event instanceof Login => 'login',
            $event instanceof Logout => 'logout',
            $event instanceof Failed => 'failed',
            default => 'unknown',
        };
    }
}
