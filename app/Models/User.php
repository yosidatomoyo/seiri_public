<?php

//
//  User.php
//
//  Created by 吉田知代 on 2022/03/15.
//  Copyright © 2021 吉田　知代. All rights reserved.
//

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'userId',
        'name',
        'password',
        'birthday',
        'remember_token',
        'secret_question',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function updateUserInformation($request)
    {
        // リクエストデータを基に登録する
        return $this
            ->where('id',Auth::id())
            ->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'birthday' => $request->birthday
            ]);
    }

    public function resetPassword($userId,$request)
    {
        // リクエストデータを基に登録する
        return $this
            ->where('userId',$userId)
            ->update([
                'password' => Hash::make($request->password),
                'remember_token' => NULL
            ]);
    }

}
