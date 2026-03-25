<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends BaseModel
{
    protected $fillable = [
        'user_id',
        'priority',
        'subject',
        'message',
        'status',
    ];

    public function replies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SupportTicketReply::class,'support_ticket_id','id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
