<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateTenantUser implements ShouldQueue
{
    use Queueable;

    public function __construct(protected Tenant $tenant){}

    public function handle(): void
    {
        $this->tenant->run(function () {
            User::create([
                'name'      => $this->tenant->name,
                'email'     => $this->tenant->email,
                'password'  => $this->tenant->password,
            ]);
        });
     }
}
