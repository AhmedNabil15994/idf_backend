<?php

return [
    'baskets' => [
        'form' => [
            'image' => 'الصورة',
            'price' => 'السعر',
            'quantity' => 'الكمية المتاحه',
            'description' => 'الوصف',
            'restore' => 'استرجاع من الحذف',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'الحالة',
            'title' => 'عنوان السله',
            'type' => 'في تذيل السله',
            'tabs' => [
                'general' => 'بيانات عامة',
                'seo' => 'SEO',
            ],
        ],
        'routes' => [
            'create' => 'اضافة السلال الغذائة',
            'index' => 'السلال الغذائة',
            'update' => 'تعديل السله',
        ],
        'datatable' => [
            'created_at' => 'تاريخ الآنشاء',
            'date_range' => 'البحث بالتواريخ',
            'options' => 'الخيارات',
            'status' => 'الحالة',
            'title' => 'العنوان',
            'description' => 'الوصف',
            'price' => 'السعر',
            'quantity' => 'الكمية المتاحه',
            'image' => 'الصورة',
        ],
        'validation' => [
            'description' => [
                'required' => 'من فضلك ادخل وصف السله',
            ],
            'title' => [
                'required' => 'من فضلك ادخل عنوان السله',
                'unique' => 'هذا العنوان تم ادخالة من قبل',
            ],
            'price' => [
                'required' => 'من فضلك ادخل السعر',
                'numeric' => 'من فضلك ادخل السعر',
                'min' => 'يجب ان يكون السعر اكبر من صفر',
            ],
            'quantity' => [
                'required' => 'من فضلك ادخل الكميه',
                'numeric' => 'من فضلك ادخل الكميه',
                'min' => 'يجب ان يكون الكميه اكبر من صفر',
            ],
        ],
    ],
];
