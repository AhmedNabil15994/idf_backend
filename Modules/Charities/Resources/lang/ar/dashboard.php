<?php

return [
    'charities' => [
        'form' => [
            'address' => 'العنوان',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'whats_app' => 'واتساب',
            'facebook' => 'رابط الفيسبوك',
            'phone' => 'رقم الهاتف',
            'logo' => 'لوجو',
            'image' => 'الصورة',
            'amount_to_collect' => 'النقود المطلوب جمعها',
            'categories' => 'القسم',
            'country' => 'الدولة',
            'description' => 'الوصف',
            'restore' => 'استرجاع من الحذف',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'الحالة',
            'title' => 'عنوان الجمعية الخيرية',
            'baskets' => 'السلال الغذائية',
            'baskets_numbers' => 'عدد السلال',
            'type' => 'في تذيل الجمعية الخيرية',
            'tabs' => [
                'general' => 'بيانات عامة',
                'seo' => 'SEO',
            ],
        ],
        'routes' => [
            'create' => 'اضافة جمعية خيرية',
            'index' => 'الجمعيات الخيرية',
            'update' => 'تعديل الجمعية الخيرية',
        ],
        'datatable' => [
            'amount_to_collect' => 'النقود المطلوب جمعها',
            'categories' => 'القسم',
            'country' => 'الدولة',
            'created_at' => 'تاريخ الآنشاء',
            'date_range' => 'البحث بالتواريخ',
            'options' => 'الخيارات',
            'status' => 'الحالة',
            'title' => 'العنوان',
            'description' => 'الوصف',
            'price' => 'السعر',
            'quantity' => 'الكمية المتاحه',
            'image' => 'الصورة',
            'logo' => 'اللوجو',
            'email' => 'البريد الإلكتروني',
            'phone' => 'رقم الهاتف',
            'families_count' => 'العائلات التابعة',
        ],
        'validation' => [
            'description' => [
                'required' => 'من فضلك ادخل وصف الجمعية الخيرية',
                'unique' => 'هذا الوصف تم ادخالة من قبل',
            ],
            'title' => [
                'required' => 'من فضلك ادخل عنوان الجمعية الخيرية',
                'unique' => 'هذا العنوان تم ادخالة من قبل',
            ],
            'address' => [
                'required' => 'من فضلك ادخل  العنوان',
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
            'logo' => [
                'image' => 'من فضلك اختر صورة',
                'mimes' => 'من فضلك اختر صورة',
            ],
        ],
    ],
];
