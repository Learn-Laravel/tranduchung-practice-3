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
            // ->leftJoin('phones', 'users.id', '=', 'phones.user_id')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->select('users.*', 'posts.*')
            ->get();
    }
    public function getOneUser($id)
    {
        return Users::with('phone', 'post')->find($id);
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
    public function post()
    {
        return $this->hasMany(Phone::class, 'user_id', 'id');
    }
}
