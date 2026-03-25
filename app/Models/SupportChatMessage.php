<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportChatMessage extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'support_chat_id',
        'from_user_id',
        'to_user_id',
        'message',
        'voice',
        'file',
    ];

    public function supportChat()
    {
        return $this->belongsTo(SupportChat::class);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }


}
