<?php

use App\Models\Setting;

return [
    'app' => [
        'title' =>  "Application Setting" ,
        'settings'  =>  [
            'app.name'  =>  [
                'lable' =>  'Aplication Title' ,
                'type' => 'text' ,
                'validate' => 'string|max:255'
            ] ,
            'app.logo' => [
                'lable' =>  'Aplication Logo' ,
                'type' => 'image' ,
                'validate' => 'image'
            ] ,
            'app.local' => [
                'lable' =>  'Defualt Language' ,
                'type' => 'select' ,
                'validate' => 'string' ,
                'options'   =>  [Setting::class ,'localeOptions'] ,
            ],
            'app.currency' => [
                'lable' =>  'Currency' ,
                'type' => 'select' ,
                'validate' => 'string' ,
                'options'   =>  [Setting::class ,'currencyOptions'] ,
            ],

            'app.timezone' => [
                'lable' =>  'Defualt Timezone' ,
                'type' => 'select' ,
                'validate' => 'string' ,
                'options'   =>  [Setting::class ,'timezoneOptions'] ,
            ],
        ],
    ] ,
];
