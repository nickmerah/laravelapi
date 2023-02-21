<?php

namespace App\Providers;

use App\Interfaces\MsgRepositoryInterface;
 
use App\Repositories\MsgRepository;
 
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(MsgRepositoryInterface::class, MsgRepository::class);
        
    }


    public function boot()
    {
        //
    }
}