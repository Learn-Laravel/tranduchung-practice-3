<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Phone extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'phones';
    protected $fillable = [
        'user_id',
        'number',
    ];
    public function getOnePhoneWithUser($id)
{
    $phoneWithUser = DB::table('phones')
        ->join('users', 'phones.user_id', '=', 'users.id')
        ->select('phones.*', 'users.*')
        ->where('phones.id', $id)
        ->first();

    return $phoneWithUser;
}
}
