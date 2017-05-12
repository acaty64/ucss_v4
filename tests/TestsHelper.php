<?php

namespace Tests;

//use Illuminate\Contracts\Console\Kernel;

trait TestsHelper
{
    protected $defaultUser;
    public function defaultUser(array $attributes = [])
    {
        if($this->defaultUser){
            return $this->defaultUser;
        }
        return $this->defaultUser = factory(User::class)->create($attributes);
    }

}
