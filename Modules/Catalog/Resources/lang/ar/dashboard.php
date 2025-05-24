<?php

return [
    'nationalities' => [
        'form' => [
            'description' => 'الوصف',
            'restore' => 'استرجاع من الحذف',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'الحالة',
            'title' => 'عنوان الجنسية',
            'type' => 'في تذيل الجنسية',
            'tabs' => [
                'general' => 'بيانات عامة',
                'seo' => 'SEO',
            ],
        ],
        'routes' => [
            'create' => 'اضافة الجنسيات',
            'index' => 'الجنسيات',
            'update' => 'تعديل الجنسية',
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
                'required' => 'من فضلك ادخل وصف الجنسية',
            ],
            'title' => [
                'required' => 'من فضلك ادخل عنوان الجنسية',
                'unique' => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],
    'partners' => [
        'form' => [
            'description' => 'الوصف',
            'restore' => 'استرجاع من الحذف',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'الحالة',
            'image' => 'الصورة',
            'link' => 'الرابط',
            'type' => 'في تذيل شريك',
            'tabs' => [
                'general' => 'بيانات عامة',
                'seo' => 'SEO',
            ],
        ],
        'routes' => [
            'create' => 'اضافة شركاء النجاح',
            'index' => 'شركاء النجاح',
            'update' => 'تعديل شريك',
        ],
        'datatable' => [
            'created_at' => 'تاريخ الآنشاء',
            'date_range' => 'البحث بالتواريخ',
            'options' => 'الخيارات',
            'status' => 'الحالة',
            'image' => 'الصورة',
            'link' => 'الرابط',
        ],
        'validation' => [

            'image' => [
                'mimes' => 'نوع الملف غير مقبول',
            ],
        ],
    ],
    'statistics' => [
        'form' => [
            'title' => 'العنوان الرئيسي',
            'sub_title' => 'العنوان الفرعي',
            'value' => 'المحتوي',
            'description' => 'الوصف',
            'restore' => 'استرجاع من الحذف',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'الحالة',
            'image' => 'الصورة',
            'link' => 'الرابط',
            'type' => 'في تذيل شريك',
            'tabs' => [
                'general' => 'بيانات عامة',
                'seo' => 'SEO',
            ],
        ],
        'routes' => [
            'create' => 'اضافة الإحصائيات',
            'index' => 'الإحصائيات',
            'update' => 'تعديل الإحصائيات',
        ],
        'datatable' => [
            'title' => 'العنوان الرئيسي',
            'sub_title' => 'العنوان الفرعي',
            'value' => 'المحتوي',
            'created_at' => 'تاريخ الآنشاء',
            'date_range' => 'البحث بالتواريخ',
            'options' => 'الخيارات',
            'status' => 'الحالة',
            'image' => 'الصورة',
            'link' => 'الرابط',
        ],
        'validation' => [

            'image' => [
                'mimes' => 'نوع الملف غير مقبول',
            ],
        ],
    ],
    'charters' => [
        'form' => [
            'title' => 'العنوان',
            'btn_title' => 'عنوان الزر',
            'description' => 'الوصف',
            'status' => 'الحالة',
            'tabs' => [
                'general' => 'بيانات عامة',
            ],
        ],
        'routes' => [
            'create' => 'اضافة مواثيق المشروع',
            'index' => 'مواثيق المشروع',
            'update' => 'تعديل مواثيق المشروع',
        ],
        'datatable' => [
            'title' => 'العنوان',
            'btn_title' => 'عنوان الزر',
            'description' => 'الوصف',
            'status' => 'الحالة',
            'created_at' => 'تاريخ الآنشاء',
            'date_range' => 'البحث بالتواريخ',
            'options' => 'الخيارات',
        ],
        'validation' => [

            'image' => [
                'mimes' => 'نوع الملف غير مقبول',
            ],
        ],
    ],
    'religions' => [
        'form' => [
            'description' => 'الوصف',
            'restore' => 'استرجاع من الحذف',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'الحالة',
            'title' => 'عنوان الديانة',
            'type' => 'في تذيل الديانة',
            'tabs' => [
                'general' => 'بيانات عامة',
                'seo' => 'SEO',
            ],
        ],
        'routes' => [
            'create' => 'اضافة الديانات',
            'index' => 'الديانات',
            'update' => 'تعديل الديانة',
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
                'required' => 'من فضلك ادخل وصف الديانة',
            ],
            'title' => [
                'required' => 'من فضلك ادخل عنوان الديانة',
                'unique' => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],

    'home-cards' => [
        'form' => [
            'link' => 'الرابط',
            'title' => 'العنوان الرئيسي',
            'sub_title' => 'العنوان الفرعي',
            'color' => 'لون البطاقة',
            'restore' => 'استرجاع من الحذف',
            'status' => 'الحالة',
            'tabs' => [
                'general' => 'بيانات عامة',
            ],
        ],
        'routes' => [
            'create' => 'إضافة بطاقات الصفحة الرئيسية',
            'index' => 'بطاقات الصفحة الرئيسية',
            'update' => 'تعديل بطاقة',
        ],
        'datatable' => [
            'title' => 'العنوان الرئيسي',
            'sub_title' => 'العنوان الفرعي',
            'color' => 'لون البطاقة',
            'created_at' => 'تاريخ الآنشاء',
            'date_range' => 'البحث بالتواريخ',
            'options' => 'الخيارات',
            'status' => 'الحالة',
            'image' => 'الصورة',
            'link' => 'الرابط',
        ],
        'validation' => [

            'image' => [
                'mimes' => 'نوع الملف غير مقبول',
            ],
        ],
    ],

    'prices' => [
        'form' => [
            'price' => 'السعر',
            'status' => 'الحالة',
            'sort' => 'الترتيب',
            'tabs' => [
                'general' => 'بيانات عامة',
            ],
        ],
        'routes' => [
            'create' => 'إضافة',
            'index' => 'اسعار التبرع السريع',
            'update' => 'تعديل ',
        ],
        'datatable' => [
            'price' => 'السعر',
            'created_at' => 'تاريخ الآنشاء',
            'date_range' => 'البحث بالتواريخ',
            'options' => 'الخيارات',
            'status' => 'الحالة',
            'sort' => 'الترتيب',
        ],
        'validation' => [

            'image' => [
                'mimes' => 'نوع الملف غير مقبول',
            ],
        ],
    ],
];
