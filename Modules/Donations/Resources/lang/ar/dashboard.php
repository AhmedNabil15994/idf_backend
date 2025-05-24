<?php

return [
    'item_types' => [
        'form' => [
            'description' => 'الوصف',
            'restore' => 'استرجاع من الحذف',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'الحالة',
            'title' => 'عنوان حالة المنتج',
            'type' => 'في تذيل حالة المنتج',
            'tabs' => [
                'general' => 'بيانات عامة',
                'seo' => 'SEO',
            ],
        ],
        'routes' => [
            'create' => 'اضافة حالات المنتجات',
            'index' => 'حالات المنتجات',
            'update' => 'تعديل حالة المنتج',
        ],
        'datatable' => [
            'created_at' => 'تاريخ الآنشاء',
            'date_range' => 'البحث بالتواريخ',
            'options' => 'الخيارات',
            'status' => 'الحالة',
            'title' => 'العنوان',
        ],
        'validation' => [
            'description' => [
                'required' => 'من فضلك ادخل وصف حالة المنتج',
            ],
            'title' => [
                'required' => 'من فضلك ادخل عنوان حالة المنتج',
                'unique' => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],

    'donors' => [
        'form' => [
            'name' => 'الإسم',
            'restore' => 'استرجاع من الحذف',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'phone' => 'رقم الهاتف',
            'status' => 'الحالة',
            'type' => 'في تذيل المتبرع',
            'tabs' => [
                'general' => 'بيانات عامة',
                'seo' => 'SEO',
            ],
        ],
        'routes' => [
            'create' => 'اضافة  المتبرعين',
            'index' => ' المتبرعين',
            'update' => 'تعديل  المتبرع',
        ],
        'datatable' => [
            'created_at' => 'تاريخ الآنشاء',
            'date_range' => 'البحث بالتواريخ',
            'options' => 'الخيارات',
            'status' => 'الحالة',
            'name' => 'الإسم',
            'restore' => 'استرجاع من الحذف',
            'email' => 'البريد الإلكتروني',
            'password' => 'كلمة المرور',
            'phone' => 'رقم الهاتف',
        ],

        'validation' => [
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
            'name' => [
                'required' => 'من فضلك ادخل الإسم',
            ],
        ],
    ],
    'donate_resources' => [
        'form' => [
            'description' => 'الوصف',
            'restore' => 'استرجاع من الحذف',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'name' => 'الإسم',
            'phone' => 'رقم الهاتف',
            'categories' => 'الأصناف',
            'quantity' => 'الكمية',
            'item_type' => 'حالة المنتج',
            'type' => 'في تذيل حالة المنتج',
            'tabs' => [
                'general' => 'بيانات عامة',
                'items' => 'المنتجات',
                'seo' => 'SEO',
            ],
        ],
        'routes' => [
            'create' => 'اضافة حالات التبرعات العينية',
            'index' => 'حالات التبرعات العينية',
            'update' => 'تعديل حالة التبرع العيني',
        ],
        'datatable' => [
            'created_at' => 'تاريخ الآنشاء',
            'date_range' => 'البحث بالتواريخ',
            'options' => 'الخيارات',
            'name' => 'الإسم',
            'phone' => 'رقم الهاتف',
            'categories' => 'الأصناف',
            'quantity' => 'الكمية',
            'item_type' => 'حالة المنتج',
        ],
        'validation' => [
            'description' => [
                'required' => 'من فضلك ادخل وصف حالة التبرع العيني',
            ],
            'title' => [
                'required' => 'من فضلك ادخل عنوان حالة التبرع العيني',
                'unique' => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],

    'donations' => [
        'routes' => [
            'create' => 'اضافة التبرعات',
            'index' => 'التبرعات',
            'update' => 'تعديل التابرع',
        ],
        'datatable' => [
            'payment_failed'    => 'فشلت عملية الدفع',
            'payment_success'   => 'تمت عملية الدفع بنجاح',
            'created_at' => 'تاريخ الآنشاء',
            'date_range' => 'البحث بالتواريخ',
            'options' => 'الخيارات',
            'status' => 'الحالة',
            'helpful' => 'فاعل خير',
            'total' => 'المبلغ الكلي',
            'donor_email' => 'البريد الإلكتروني',
            'payment_method' => 'بوابة الدفع',
            'name' => 'الإسم',
            'phone' => 'رقم الهاتف',
            'categories' => 'الأصناف',
            'quantity' => 'الكمية',
            'pending' => 'في حالة الإنتظار',
            'show' => 'عرض',
            'item_type' => 'حالة المنتج',
            'project' => 'اسم المشروع',
            'donor_name' => 'اسم المتبرع',
            'donor_mobile' => 'رقم المتبرع',
        ],
        'modal' => [
            'show_donation' => ' عرض التبرع',
            'created_at' => 'تاريخ الآنشاء',
            'status' => 'الحالة',
            'total' => 'المبلغ الكلي',
            'payment_method' => 'بوابة الدفع',
            'donor' => 'المتبرع',
            'donation_data' => 'بيانات التبرع',
            'donation' => 'التبرع',
            'donor_info' => 'بيانات المتبرع',
            'name' => 'الإسم',
            'email' => 'البريد الإلكتروني',
            'phone' => 'رقم الهاتف',
            'donation_content' => 'محتوي التبرع',
            'type' => 'النوع',
            'title' => 'العنوان',
            'amount' => 'المبلغ',
            'donor_info_not_entered' => 'بيانات المتبرع مجهوله',
            'projects' => 'المشاريع',
            'food_baskets' => 'السلات الغزائية',
            'data_not_found' => 'لم يتم العثور علي بيانات',

        ],
    ],
];
