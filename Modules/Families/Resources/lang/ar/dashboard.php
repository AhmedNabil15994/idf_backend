<?php

return [
    'families' => [
        'form' => [
            'head_name' => 'اسم رب الأسرة',
            'phone' => 'رقم الهاتف',
            'national_id' => 'رقم البطاقة',
            'nationality' => 'الجنسية',
            'current_salary' => 'الراتب الحالي',
            'gender' => 'الجنس',
            'male' => 'ذكر',
            'female' => 'انثي',
            'marital_status' => 'الحالة الإجتماعية',
            'married' => 'متذوج',
            'single' => 'أعزب',
            'widower' => 'أرمل',
            'divorce' => 'مطلق',
            'members_count' => 'عدد أفراد الأسرة',
            'name' => 'إسم المستفيد',
            'governorate' => 'المحافظة',
            'city' => 'المنطقة',
            'region' => 'القطعه',
            'gada_number' => 'رقم الجاده',
            'ale_number' => 'رقم الألي',
            'street' => 'الشارع',
            'building_number' => 'رقم المبني',
            'floor_number' => 'رقم الدور',
            'apartment' => 'الشقة',
            'charities' => 'الجمعيات الخيرية',
            'attachments' => 'الملفات',
            'religion' => 'الديانة',
            'restore' => 'استرجاع من الحذف',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'الحالة',
            'baskets' => 'السلال الغذائية',
            'basket_name' => 'إسم السلة',
            'baskets_numbers' => 'عدد السلال',
            'tabs' => [
                'general' => 'بيانات عامة',
                'family_members' => 'بيانات المستفيدين',
                'address' => 'العنوان',
                'baskets' => 'السلال الغذائية',
                'attachments' => 'المستندات المطلوبة ان وجدت',
                'seo' => 'SEO',
            ],
        ],
        'routes' => [
            'create' => 'اضافة العائلات',
            'index' => 'العائلات',
            'update' => 'تعديل العائلة',
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
            'name' => 'رب الأسرة',
            'phone' => 'رقم الهاتف',
            'current_salary' => 'الراتب الحالي',
            'members_count' => 'عدد أفراد الأسره',
            'charities' => 'الجمعيات الخيريه',
            'baskets' => 'السلات الغذائية',
            'not_joined' => 'غير منضم',
        ],
        'validation' => [
            'head_name' => [
                'required' => 'الرجاء إدخال  اسم رب الأسرة',
            ],
            'head_phone' => [
                'required' => 'الرجاء إدخال  رقم الهاتف',
            ],
            'head_national_id' => [
                'required' => 'الرجاء إدخال  رقم البطاقة',
                'unique' => 'رقم البطاقة مسجل بالفعل',
            ],
            'head_nationality_id' => [
                'required' => 'الرجاء إختيار الجنسية',
            ],
            'head_religion_id' => [
                'required' => 'الرجاء إختيار الديانة',
            ],
            'head_current_salary' => [
                'required' => 'الرجاء إدخال  الراتب الحالي',
            ],
            'head_gender' => [
                'required' => 'الرجاء إختيار الجنس',
            ],
            'head_marital_status' => [
                'required' => 'الرجاء إختيار الحالة الإجتماعية',
            ],
            'members_count' => [
                'required' => 'الرجاء إدخال  عدد أفراد الأسرة',
                'min' => 'يجد أن يكون عدد أفراد الأسرة أكبر من صفر',
            ],
            'members' => [
                'not_equal' => 'بيانات المستفيدين غير متابقة لعدد أفراد الأسره',
            ],
            'members_names' => [
                'required' => 'الرجاء إدخال  أسماء المستفيدين',
            ],
            'members_national_ids' => [
                'required' => 'الرجاء إدخال  أرقام بطاقات المستفيدين',
                'unique' => 'رقم البطاقة المستفيد مسجله بالفعل',
            ],
            'governorate' => [
                'required' => 'الرجاء إختيار  المحافظة',
            ],
            'city' => [
                'required' => 'الرجاء إختيار  المنطقة',
            ],
            'region_id' => [
                'required' => 'الرجاء إختيار  القطعه',
            ],
            'gada_number' => [
                'required' => 'الرجاء إدخال  رقم الجاده',
            ],
            'ale_number' => [
                'required' => 'الرجاء إدخال  رقم الألي',
            ],
            'street' => [
                'required' => 'الرجاء إدخال  الحي',
            ],
            'building_number' => [
                'required' => 'الرجاء إدخال  رقم المبني',
            ],
            'floor_number' => [
                'required' => 'الرجاء إدخال  رقم الدور',
            ],
            'apartment' => [
                'required' => 'الرجاء إدخال  الشقة',
            ],
            'charities' => [
                'exists' => 'الرجاء إدخال  الجمعيات الخيرية',
            ],
            'attachments' => [
                'max' => 'لا يمكن أن يكون حجم الملف أكبر من 10 ميجا ',
                'mimes' => 'خطأ في نوع الملفات المرفوعه',
            ],
        ],
    ],
];
