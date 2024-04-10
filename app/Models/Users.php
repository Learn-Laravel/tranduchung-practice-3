<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    public function getAllUser()
    {
        return DB::table('users')
            ->leftJoin('phones', 'users.id', '=', 'phones.user_id')
            ->select('users.*', 'phones.number as phone_number')
            ->get();
    }
    public function getOneUser($id)
    {
        $users = Users::with('phone')
            ->find($id);
        return $users;
    }
    public function createUser($data)
    {
        return DB::table($this->table)->insert($data);
    }
    public function updateUser($data, $id)
    {
        return DB::table($this->table)->where('id', $id)->update($data);
    }
    public function deleteUser($id)
    {
        return DB::table($this->table)->where('id', $id)->delete();
    }
    public function phone()
    {
        return $this->hasOne(Phone::class, 'user_id', 'id');
    }
}
