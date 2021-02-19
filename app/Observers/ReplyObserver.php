<?php

namespace App\Observers;

use App\Models\Reply;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function created(Reply $reply)
    {
        $topic= $reply->topic()->first(['id','reply_count']);
        $topic->reply_count =$topic->replies()->count();
        $topic->save();
    }

    public function creating(Reply $reply)
    {
      $reply->content = clean($reply->content, 'user_topic_body');
    }

    public function updating(Reply $reply)
    {
        //
    }
}
