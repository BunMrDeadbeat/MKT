<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministrativeNotificationRecipient extends Model
{
    //
    protected $table = 'administrative_notification_recipients';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
