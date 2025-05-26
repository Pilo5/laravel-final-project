<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employeeid',
        'first_name',
        'last_name',
        'email',
        'image_path'
    ];

    public function userAccount()
    {
        return $this->hasOne(UserAccount::class, 'useraccount_id');
    }
}
