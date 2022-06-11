<?php

//　ひらがなチェック
//  Hiragana.php
//
//  Created by 吉田知代 on 2022/05/17.
//  Copyright © 2021 吉田　知代. All rights reserved.
//


namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Hiragana implements Rule
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
        return preg_match('/^[ぁ-ゞ]+$/u', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attributeはひらがなで入力してください';
    }
}
