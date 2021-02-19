<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Mdoels\User;
use App\Mdoels\Topic;

class RepliesTableSeeder extends Seeder
{
    public function run()
    {
        $replies = factory(Reply::class)->times(1000)->create();
    }

}

