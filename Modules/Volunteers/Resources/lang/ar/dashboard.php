<?php

return [
    'volunteers' => [
        'form' => [
            'name' => 'الإسم',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'phone' => 'رقم الهاتف',
            'image' => 'الصورة',
            'amount_to_collect' => 'النقود المطلوب جمعها',
            'restore' => 'استرجاع من الحذف',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'الحالة',
            'type' => 'في تذيل المتطوعين',
            'tabs' => [
                'general' => 'بيانات عامة',
                'seo' => 'SEO',
            ],
        ],
        'routes' => [
            'create' => 'اضافة متطوع',
            'index' => 'المتطوعين',
            'update' => 'تعديل المتطوعين',
        ],
        'datatable' => [
            'charity' => 'الجمعية التابع لها',
            'amount_to_collect' => 'النقود المطلوب جمعها',
            'created_at' => 'تاريخ الآنشاء',
            'date_range' => 'البحث بالتواريخ',
            'options' => 'الخيارات',
            'status' => 'الحالة',
            'name' => 'الإسم',
            'image' => 'الصورة',
            'email' => 'البريد الإلكتروني',
            'phone' => 'رقم الهاتف',
            'families_count' => 'العائلات التابعة',
            'not_joined' => 'غير منضم',
        ],
        'validation' => [
            'name' => [
                'required' => 'من فضلك ادخل إسم المتطوع',
            ],
            'email' => [
                'required' => 'من فضلك ادخل البريد الإلكتروني',
                'email' => 'من فضلك ادخل البريد الإلكتروني',
                'unique'    => 'هذا البريد تم ادخالة من قبل',
            ],
            'password' => [
                'required' => 'من فضلك ادخل كلمة المرور',
                'min' => 'يجب أن تكون كلمة المرور أكبر من 6 حروف',
            ],
            'phone' => [
                'required' => 'من فضلك ادخل رقم الهاتف',
            ],
            'image' => [
                'image' => 'من فضلك اختر صورة',
                'mimes' => 'من فضلك اختر صورة',
            ],
        ],
    ],
];
