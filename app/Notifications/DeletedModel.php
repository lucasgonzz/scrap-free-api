<?php

namespace App\Notifications;

use App\Http\Controllers\CommonLaravel\Helpers\UserHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class DeletedModel extends Notification {
    use Queueable;

    public $model_name;
    public $model_id;

    public function __construct($model_name, $model_id) {
        $this->model_name = $model_name;
        $this->model_id = $model_id;
    }

    public function via($notifiable) {
        return ['broadcast'];
    }

    public function broadcastOn() {
        return 'deleted_model.'.UserHelper::userId();
    }

    public function toBroadcast($notifiable) {
        return new BroadcastMessage([
            'model_name'    => $this->model_name,
            'model_id'      => $this->model_id,
        ]);
    }
}
