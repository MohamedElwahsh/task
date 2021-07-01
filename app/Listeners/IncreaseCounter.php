<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        if( session() -> has('videoIsVisited') ){
        $this -> updateViewers ( $event -> videos );
        }else{
            return false;
        }
    }
    function updateViewers($varVideo){
        $varVideo -> viewers = $varVideo -> viewers + 1;
        $varVideo -> save();
        session() -> put('videoIsVisited', $varVideo ->id);
    }
}
