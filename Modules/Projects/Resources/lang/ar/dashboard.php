<?php

return [
    'projects' => [
        'form' => [
            'image' => 'الصورة',
            'amount_to_collect' => 'النقود المطلوب جمعها',
            'categories' => 'القسم',
            'country' => 'الدولة',
            'restore' => 'استرجاع من الحذف',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'الحالة',
            'title' => 'عنوان المشروع',
            'description' => 'الوصف',
            'type' => 'في تذيل المشروع',
            'tabs' => [
                'general' => 'بيانات عامة',
                'seo' => 'SEO',
            ],
        ],
        'routes' => [
            'create' => 'اضافة المشاريع',
            'index' => 'المشاريع',
            'update' => 'تعديل المشروع',
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
            'total_donation' => 'إجمالي التبرعات',
        ],
        'validation' => [
            'description' => [
                'required' => 'من فضلك ادخل وصف المشروع',
            ],
            'title' => [
                'required' => 'من فضلك ادخل عنوان المشروع',
                'unique' => 'هذا العنوان تم ادخالة من قبل',
            ],
            'country_id' => [
                'required' => 'من فضلك إختر الدولة',
                'unique' => 'هذا العنوان تم ادخالة من قبل',
            ],
            'categories' => [
                'required' => 'من فضلك حدد الأقسام',
            ],
            'amount_to_collect' => [
                'numeric' => 'من فضلك ادخل النقود المطلوب جمعها',
                'min' => 'يجب ان يكون النقود اكبر من صفر',
            ],
        ],
    ],
];
