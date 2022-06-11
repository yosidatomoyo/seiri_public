<?php

//　半角英数チェック
//  AlphaNumHalf.php
//
//  Created by 吉田知代 on 2022/05/17.
//  Copyright © 2021 吉田　知代. All rights reserved.
//

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlphaNumHalf implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     return preg_match('/^[!-~]+$/', $value);
    // }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^[!-~]+$/', $value);
        }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attributeは半角英数字で入力してください';
    }
}
