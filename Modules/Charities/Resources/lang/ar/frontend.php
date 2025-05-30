<?php

return [
    'charities' => [
        'by_registering_you_agree_to' => 'من خلال التسجيل تكون قد وافقت على',
        'btn' =>[
            'ask_join' => 'طلب انضمام',
            'project_charter' => 'ميثاق المشروع',
        ],
        'form' => [
            'address' => 'العنوان',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'whats_app' => 'واتساب',
            'facebook' => 'رابط الفيسبوك',
            'phone' => 'رقم الهاتف',
            'contact_name' => 'الاسم للتواصل',
            'charity_name' => 'اسم الجمعية',
        ],
        'routes' => [
            'create' => 'اضافة جمعية خيرية',
            'index' => 'الجمعيات الخيرية',
            'update' => 'تعديل الجمعية الخيرية',
        ],
        'validation' => [
            'name' => [
                'required' => 'من فضلك ادخل الاسم للتواصل ',
            ],
            'charity_name' => [
                'required' => 'من فضلك ادخل عنوان الجمعية الخيرية',
                'unique' => 'هذا العنوان تم ادخالة من قبل',
            ],
            'email' => [
                'required' => 'من فضلك ادخل البريد الإلكتروني',
                'email' => 'من فضلك ادخل البريد الإلكتروني',
                'unique'    => 'هذا البريد تم ادخالة من قبل',
            ],
            'phone' => [
                'required' => 'من فضلك ادخل رقم الهاتف',
                'unique'    => 'هذا الهاتف تم ادخالة من قبل',
            ],
        ],
    ],
];
