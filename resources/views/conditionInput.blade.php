<!-- 
　 体調入力
  conditionInput.blade.php

  Created by 吉田知代 on 2022/05/1.
  Copyright © 2021 吉田　知代. All rights reserved.
 -->


<x-app-layout>
    <x-slot name="header">
    </x-slot>


<html lang="ja">

    <head>
        <link rel="stylesheet" href="{{ asset('css/conditionInput.css') }}">
        <link rel="stylesheet" href="{{ asset('css/button.css') }}">
        <link rel="stylesheet" href="{{ asset('css/frame.css') }}">


        <!-- Required meta tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--FontAwesome-->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/calender.css') }}">
    </head> 

 
    <div class="space">
        <x-condition-input-validation-error class="mb-4" :errors="$errors" />
        @if (session('flash_message'))
            <div class="flash_message font-medium text-green-600">
                {{ session('flash_message') }}
            </div>
        @endif

        <!-- <fieldset>
             <input id="detail" class="radio-inline__input" type="radio" name="accessible-radio" :value="detail" checked="checked"
            onclick="document.getElementById('detailInput').style.display = 'block'; document.getElementById('simpleInput').style.display = 'block';"/>
            <label class="radio-inline__label" for="detail">
                詳細入力
            </label>

            <input id="easy" class="radio-inline__input" type="radio" name="accessible-radio" :value="easy"
            onclick="document.getElementById('detailInput').style.display = 'none' ;document.getElementById('simpleInput').style.display = 'none';"/>
            <label class="radio-inline__label" for="easy">
                簡易入力
            </label>
        </fieldset> -->
        <form action="{{ route('conditionInput.store') }}" method="POST">
         @csrf
            <div class="frame">
                <div class="row">
                    <div class="red col-12 col-md-6">
                        <div class="py-1 ">

                            <div class="contents">
                                <div class="itemLabel">
                                    <p class ="">{{ __('日付') }}</p>
                                </div>
                                <div class="item">
                                    <x-input id="report_date" 
                                    type="date" 
                                    name="report_date" 
                                    :value="$seiri_informations->report_date" 
                                    required autofocus/>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                <p class ="">{{ __('生理') }}</p>
                                </div>
                                <div class="item">
                                    <div class="buttonPosition">
                                        <input id="menstruation_start_date" 
                                            class="radio-inline__input" 
                                            type="radio" 
                                            name="menstruation_date" 
                                            value="1" 
                                            <?php if($seiri_informations->menstruation_start_date != NULL){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                            onclick="radioDeselection(this, 25)"
                                        />
                                        <label class="radio-inline__label" for="menstruation_start_date" value="1"> {{ __('開始') }}
                                        </label>

                                        <input id="menstruation_end_date" 
                                            class="radio-inline__input" 
                                            type="radio" 
                                            name="menstruation_date" 
                                            value="2" 
                                            <?php if($seiri_informations->menstruation_end_date != NULL){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                            onclick="radioDeselection(this, 26)"
                                        />
                                        
                                        <label class="radio-inline__label" for="menstruation_end_date" value="2">{{ __('終了') }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p class ="">{{ __('体調') }}</p>
                                </div>
                                <div class="item">
                                    <fieldset>
                                        @foreach ($masters as $master)
                                        @if ($master->id === 22) 
                                        <input id="body_condition_good" 
                                            class="radio-inline__input" 
                                            type="radio" name="body_condition" 
                                            value="{{ $master->id }}"  
                                            onclick="radioDeselection(this, 1)"
                                            <?php if($seiri_informations->body_condition == 22){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="body_condition_good" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>

                                        @if ($master->id === 23) 
                                        <input id="body_condition_soso" 
                                            class="radio-inline__input" 
                                            type="radio" name="body_condition" 
                                            value="{{$master->id}}" 
                                            onclick="radioDeselection(this, 2)"
                                            <?php if($seiri_informations->body_condition == 23){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="body_condition_soso" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>

                                        @if ($master->id === 24) 
                                        <input id="body_condition_bad" 
                                            class="radio-inline__input" 
                                            type="radio" name="body_condition" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 3)"
                                            <?php if($seiri_informations->body_condition == 24){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="body_condition_bad" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>
                                        @endforeach
                                    </fieldset>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p class ="">{{ __('体温') }}</p>
                                </div>
                                <div class="item">
                                    <x-input id="body_temperature" 
                                        type="text" 
                                        name="body_temperature" 
                                        :value="$seiri_informations->body_temperature" 
                                        maxlength="5" 
                                        placeholder="00.00"
                                    />
                                    {{ __('℃') }}
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p class ="">{{ __('気分') }}</p>
                                </div>
                                <div class="item">
                                    <fieldset>
                                        @foreach ($masters as $master)
                                        @if ($master->id === 22) 
                                        <input id="good" 
                                            class="radio-inline__input" 
                                            type="radio" 
                                            name="feeling" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 4)"
                                            <?php if($seiri_informations->feeling == 22){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                          />
                                        <label class="radio-inline__label" for="good" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>

                                        @if ($master->id === 23) 
                                        <input id="soso" 
                                            class="radio-inline__input" 
                                            type="radio" name="feeling" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 5)"
                                            <?php if($seiri_informations->feeling == 23){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="soso" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>

                                        @if ($master->id === 24) 
                                        <input id="bad" 
                                            class="radio-inline__input" 
                                            type="radio" name="feeling" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 6)"
                                            <?php if($seiri_informations->feeling == 24){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="bad" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>
                                        @endforeach
                                    </fieldset>
                                </div>
                            </div>

                            <div id="simpleInput">
                                <div class="contents">
                                    <div class="itemLabel">
                                        <p class ="">{{ __('おりもの') }}</p>
                                    </div>
                                    <div class="item">
                                            <div class="form-group">
                                            <label for="color">{{ __('色') }}</label>
                                            <select class=" listbox js-choices rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="menstrual_discharge_color" name="menstrual_discharge_color">
                                                <option value =""></option>
                                                @foreach ($masters as $master)
                                                @if ($master->master_key === 1001) 
                                                    <option 
                                                    value="{{ $master->id }}"
                                                    <?php if($seiri_informations->menstrual_discharge_color == $master->id ){ ?>
                                                    selected
                                                    <?php }else{ ?>
                                                    <?php } ?>>
                                                    {{ $master->column_name }}
                                                    </option>
                                                @endif
                                                @endforeach

                                            </select>
                                            </div>
                                    </div>
                                    <div class="item">
                                            <div class="form-group">
                                            <label for="job">{{ __('質') }}</label>
                                            <select class="listbox js-choices rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="menstrual_discharge_quality" name="menstrual_discharge_quality">
                                                <option value =""></option>
                                                @foreach ($masters as $master)
                                                @if ($master->master_key === 1002) 
                                                    <option 
                                                    value="{{ $master->id }}"
                                                    <?php if($seiri_informations->menstrual_discharge_quality == $master->id ){ ?>
                                                    selected
                                                    <?php }else{ ?>
                                                    <?php } ?>>
                                                    {{ $master->column_name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            </div>
                                    </div>
                                    <div class="item">
                                            <div class="form-group">
                                            <label for="job">{{ __('量') }}</label>
                                            <select class="listbox js-choices rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="menstrual_discharge_volume" name="menstrual_discharge_volume">
                                                <option value =""></option>
                                                @foreach ($masters as $master)
                                                @if ($master->master_key === 1007) 
                                                    <option 
                                                    value="{{ $master->id }}"
                                                    <?php if($seiri_informations->menstrual_discharge_volume == $master->id ){ ?>
                                                    selected
                                                    <?php }else{ ?>
                                                    <?php } ?>>
                                                    {{ $master->column_name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            </div>
                                    </div>
                                </div>

                                <div class="contents">
                                    <div class="itemLabel">
                                        <p class ="">{{ __('便通') }}</p>
                                    </div>
                                    <div class="item">
                                        <div class="form-group">
                                            <label for="job">{{ __('色') }}</label>
                                            <select class="listbox js-choices rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="constipation_color" name="constipation_color">
                                                <option value =""></option>
                                                @foreach ($masters as $master)
                                                @if ($master->master_key === 1003) 
                                                    <option 
                                                    value="{{ $master->id }}"
                                                    <?php if($seiri_informations->constipation_color == $master->id ){ ?>
                                                    selected
                                                    <?php }else{ ?>
                                                    <?php } ?>>
                                                    {{ $master->column_name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="form-group">
                                            <label for="job">{{ __('質') }}</label>
                                            <select class="listbox js-choices rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="constipation_quality" name="constipation_quality">
                                                <option value =""></option>
                                                @foreach ($masters as $master)
                                                @if ($master->master_key === 1004) 
                                                    <option 
                                                    value="{{ $master->id }}"
                                                    <?php if($seiri_informations->constipation_quality == $master->id ){ ?>
                                                    selected
                                                    <?php }else{ ?>
                                                    <?php } ?>>
                                                    {{ $master->column_name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="form-group">
                                            <label for="job">{{ __('量') }}</label>
                                            <select class="listbox js-choices rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="constipation_volume" name="constipation_volume">
                                                <option value =""></option>
                                                @foreach ($masters as $master)
                                                @if ($master->master_key === 1007) 
                                                    <option 
                                                    value="{{ $master->id }}"
                                                    <?php if($seiri_informations->constipation_volume == $master->id ){ ?>
                                                    selected
                                                    <?php }else{ ?>
                                                    <?php } ?>>
                                                    {{ $master->column_name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                </div>                            
                            </div>  
                        </div>  
                


                    <div class="red col-12 col-md-6">  

                    <div class="contents">
                            <div class="itemLabel">
                                <p class ="">{{ __('生理痛') }}</p>
                            </div>
                            <div class="item">
                                <fieldset>
                                    @foreach ($masters as $master)
                                    @if ($master->id === 19) 
                                    <input id="menstrual_pain_good" 
                                        class="radio-inline__input" 
                                        type="radio" 
                                        name="menstrual_pain" 
                                        value="{{ $master->id }}" 
                                        onclick="radioDeselection(this, 7)"
                                        <?php if($seiri_informations->menstrual_pain == 19){ ?>
                                        checked="checked"
                                        <?php }else{ ?>
                                        <?php } ?>
                                    />
                                    <label class="radio-inline__label" for="menstrual_pain_good" value="{{ $master->id }}">{{ $master->column_name }}
                                    @endif
                                    </label>

                                    @if ($master->id === 20) 
                                    <input id="menstrual_pain_soso" 
                                        class="radio-inline__input" 
                                        type="radio" 
                                        name="menstrual_pain" 
                                        value="{{ $master->id }}" 
                                        onclick="radioDeselection(this, 8)"
                                        <?php if($seiri_informations->menstrual_pain == 20){ ?>
                                        checked="checked"
                                        <?php }else{ ?>
                                        <?php } ?>
                                    />
                                    <label class="radio-inline__label" for="menstrual_pain_soso" value="{{ $master->id }}">{{ $master->column_name }}
                                    @endif
                                    </label>

                                    @if ($master->id === 21) 
                                    <input id="menstrual_pain_bad" 
                                        class="radio-inline__input" 
                                        type="radio" 
                                        name="menstrual_pain" 
                                        value="{{ $master->id }}" 
                                        onclick="radioDeselection(this, 9)"
                                        <?php if($seiri_informations->menstrual_pain == 21){ ?>
                                        checked="checked"
                                        <?php }else{ ?>
                                        <?php } ?>
                                    />
                                    <label class="radio-inline__label" for="menstrual_pain_bad" value="{{ $master->id }}">{{ $master->column_name }}
                                    @endif
                                    </label>
                                    @endforeach
                                </fieldset>
                            </div>
                        </div>

                        <div class="contents">
                            <div class="itemLabel">
                                <p class ="">{{ __('経血量') }}</p>
                            </div>
                            <div class="item">
                                <fieldset>
                                    @foreach ($masters as $master)
                                    @if ($master->id === 25) 
                                    <input id="menstrual_blood_volume_good" 
                                        class="radio-inline__input" 
                                        type="radio" 
                                        name="menstrual_blood_volume" 
                                        value="{{ $master->id }}" 
                                        onclick="radioDeselection(this, 10)"
                                        <?php if($seiri_informations->menstrual_blood_volume == 25){ ?>
                                        checked="checked"
                                        <?php }else{ ?>
                                        <?php } ?>
                                    />
                                    <label class="radio-inline__label" for="menstrual_blood_volume_good" value="{{ $master->id }}">{{ $master->column_name }}
                                    @endif
                                    </label>

                                    @if ($master->id === 26) 
                                    <input id="menstrual_blood_volume_soso" 
                                        class="radio-inline__input" 
                                        type="radio" 
                                        name="menstrual_blood_volume" 
                                        value="{{ $master->id }}" 
                                        onclick="radioDeselection(this, 11)"
                                        <?php if($seiri_informations->menstrual_blood_volume == 26){ ?>
                                        checked="checked"
                                        <?php }else{ ?>
                                        <?php } ?>
                                    />
                                    <label class="radio-inline__label" for="menstrual_blood_volume_soso" value="{{ $master->id }}">{{ $master->column_name }}
                                    @endif
                                    </label>

                                    @if ($master->id === 27) 
                                    <input id="menstrual_blood_volume_bad" 
                                        class="radio-inline__input" 
                                        type="radio" 
                                        name="menstrual_blood_volume" 
                                        value="{{ $master->id }}" 
                                        onclick="radioDeselection(this, 12)"
                                        <?php if($seiri_informations->menstrual_blood_volume == 27){ ?>
                                        checked="checked"
                                        <?php }else{ ?>
                                        <?php } ?>
                                    />
                                    <label class="radio-inline__label" for="menstrual_blood_volume_bad" value="{{ $master->id }}">{{ $master->column_name }}
                                    @endif
                                    </label>
                                    @endforeach
                                </fieldset>
                            </div>
                        </div>

                        <div id="detailInput">
                            <div class="contents">
                                <div class="itemLabel">
                                    <p class ="">{{ __('頭痛') }}</p>
                                </div>
                                <div class="item">
                                    <fieldset>
                                        @foreach ($masters as $master)
                                        @if ($master->id === 19) 
                                        <input id="very_headache" 
                                            class="radio-inline__input" 
                                            type="radio" 
                                            name="headache" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 13)"
                                            <?php if($seiri_informations->headache == 19){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="very_headache" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>

                                        @if ($master->id === 20) 
                                        <input id="headache" 
                                            class="radio-inline__input" 
                                            type="radio" name="headache" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 14)"
                                            <?php if($seiri_informations->headache == 20){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="headache" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>

                                        @if ($master->id === 21) 
                                        <input id="litte_headache" 
                                            class="radio-inline__input" 
                                            type="radio" 
                                            name="headache" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 15)"
                                            <?php if($seiri_informations->headache == 21){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="litte_headache" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>
                                        @endforeach
                                    </fieldset>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p class ="">{{ __('腰痛') }}</p>
                                </div>
                                <div class="item">
                                    <fieldset>
                                        @foreach ($masters as $master)
                                        @if ($master->id === 19) 
                                        <input id="very_lower_back_pain" 
                                            class="radio-inline__input" 
                                            type="radio" 
                                            name="lower_back_pain" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 16)"
                                            <?php if($seiri_informations->lower_back_pain == 19){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="very_lower_back_pain" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>

                                        @if ($master->id === 20) 
                                        <input id="lower_back_pain" 
                                            class="radio-inline__input" 
                                            type="radio" 
                                            name="lower_back_pain" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 17)"
                                            <?php if($seiri_informations->lower_back_pain == 20){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="lower_back_pain" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>

                                        @if ($master->id === 21) 
                                        <input id="litte_lower_back_pain" 
                                            class="radio-inline__input" 
                                            type="radio" name="lower_back_pain" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 18)"
                                            <?php if($seiri_informations->lower_back_pain == 21){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="litte_lower_back_pain" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>
                                        @endforeach
                                    </fieldset>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p class ="">{{ __('腹痛') }}</p>
                                </div>
                                <div class="item">
                                    <fieldset>
                                        @foreach ($masters as $master)
                                        @if ($master->id === 19) 
                                        <input id="very_stomach_ache" 
                                            class="radio-inline__input" 
                                            type="radio" 
                                            name="stomach_ache" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 19)"
                                            <?php if($seiri_informations->stomach_ache == 19){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="very_stomach_ache" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>

                                        @if ($master->id === 20) 
                                        <input id="stomach_ache" 
                                            class="radio-inline__input" 
                                            type="radio" 
                                            name="stomach_ache" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 20)"
                                            <?php if($seiri_informations->stomach_ache == 20){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="stomach_ache" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>

                                        @if ($master->id === 21) 
                                        <input id="little_stomach_ache" 
                                            class="radio-inline__input" 
                                            type="radio" 
                                            name="stomach_ache" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 21)"
                                            <?php if($seiri_informations->stomach_ache == 21){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="little_stomach_ache" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>
                                        @endforeach
                                    </fieldset>
                                </div>
                            </div>

                            <div class="contents">
                                <div class="itemLabel">
                                    <p class ="">{{ __('胸の張り') }}</p>
                                </div>
                                <div class="item">
                                    <fieldset>
                                        @foreach ($masters as $master)
                                        @if ($master->id === 19) 
                                        <input id="very_chest_tension" 
                                            class="radio-inline__input" 
                                            type="radio" 
                                            name="chest_tension" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 22)"
                                            <?php if($seiri_informations->chest_tension == 19){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="very_chest_tension" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>

                                        @if ($master->id === 20) 
                                        <input id="chest_tension" 
                                            class="radio-inline__input" 
                                            type="radio" 
                                            name="chest_tension" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 23)"
                                            <?php if($seiri_informations->chest_tension == 20){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="chest_tension" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>

                                        @if ($master->id === 21) 
                                        <input id="littlechest_tension" 
                                            class="radio-inline__input" 
                                            type="radio"
                                            name="chest_tension" 
                                            value="{{ $master->id }}" 
                                            onclick="radioDeselection(this, 24)"
                                            <?php if($seiri_informations->chest_tension == 21){ ?>
                                            checked="checked"
                                            <?php }else{ ?>
                                            <?php } ?>
                                        />
                                        <label class="radio-inline__label" for="littlechest_tension" value="{{ $master->id }}">{{ $master->column_name }}
                                        @endif
                                        </label>
                                        @endforeach
                                    </fieldset>
                                </div>
                            </div>
                        </div>

                        <div class="contents">
                            <div class="itemLabel">
                                <p class ="">{{ __('メモ') }}</p>
                            </div>
                            <div class="item">
                                <textarea 
                                    class="memo rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                    id="memo" name="memo" :value="{{$seiri_informations->memo}}" maxlength="255"><?php echo $seiri_informations->memo;?>
                                </textarea>
                            </div>
                        </div>
                        
                    </div>      
                </div>                
                </div>
                
                <fieldset>
                <button type="submit" class="Button">
                    {{ __('登録') }}
                </button>
                </fieldset>
                </div>
            </div>  
        </form>
    </div>

    <script>
        var remove = 0;
        function radioDeselection(already, numeric) {
            if(remove == numeric) {
                already.checked = false;
                remove = 0;
            } else {
                remove = numeric;
            }
        }

        function dateSearch(e) {
            let param = location.search
            let stringParam = String(param);
            let dateParam = stringParam.replace("?day=", "");
            const dateSince = document.getElementById("report_date");
            const value = e.target.value;


            if(value != dateParam){
                var url = new URL(window.location.href);
                    url.searchParams.set('day',value);
                    location.href = url;
            }
        }

        window.onload = () => {
        document.getElementById("report_date").addEventListener("blur", dateSearch);
        input.focus();
        }

    </script>
    </html>

</x-app-layout>
