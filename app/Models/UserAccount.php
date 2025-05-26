<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;

    protected $table = 'user_accounts';

    protected $fillable = [
        'username',
        'password',
        'defaultpassword',
        'status',
        'useraccount_id'
    ];

    protected $hidden = [
        'password',
        'defaultpassword',
    ];

    public function employee() {
        return $this->belongsTo(\App\Models\Employee::class, 'useraccount_id');
    }
    
}
