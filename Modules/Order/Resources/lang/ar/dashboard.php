<?php

return [
    'orders' => [
        'messages' => [
            'failed' => 'لا يوجد عائلات مسجله بالنظام',
            'please_select_orders_you_need_to_assign' => 'الرجاء اختيارات الطلبات التي تود تعيينها',
            'please_select_orders_you_need_to_print' => 'الرجاء اختيارات الطلبات التي تود طباعتها',
            'please_select_volunteer' => 'الرجاء إختيار المتطوع',
        ],
        'form' => [

            'families' => 'العائلات',
            'all' => 'الكل',
            'select_families' => 'اختيار العائلات',
            'volunteer' => 'المتطوع',
            'period' => 'الفتره (أيام)',
            'volunteer_note' => 'ملاحظة للمتطوع',
            'restore' => 'استرجاع من الحذف',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'pending' => 'جديد',
            'delivered' => 'تم التوصيل',
            'status' => 'الحالة',
            'title' => 'عنوان الطلب',
            'type' => 'في تذيل الطلب',
            'tabs' => [
                'general' => 'بيانات عامة',
                'seo' => 'SEO',
            ],
        ],
        'routes' => [
            'create' => 'اضافة الطلبات',
            'index' => 'الطلبات',
            'update' => 'تعديل الطلب',
        ],
        'datatable' => [
            'governorate' => 'المحافظات',
            'city' => 'المدن',
            'volunteers' => 'المتطوعين',
            'volunteer_name' => 'إسم المتطوع',
            'created_at' => 'تاريخ الآنشاء',
            'date_range' => 'البحث بالتواريخ',
            'options' => 'الخيارات',
            'status' => 'الحالة',
            'assign_volunteer' => 'تعيين المتطوع',
            'family_leader_name' => 'رب الأسره',
            'family_members_count' => 'عدد أفراد الأسره',
            'period' => 'الفتره الزمنيه لتوصيل الطلب',
            'baskets_count' => 'عدد السلات',
            'days' => 'الأيام',
            'status_name' => [
                'pending' => 'إنتظار',
                'delivered' => 'تم التوصيل',
            ],
        ],
        'validation' => [
            'families_type' => [
                'required' => 'الرجاء إختيار قيمة',
            ],
            'status' => [
                'required' => 'الرجاء إختيار قيمة',
            ],
            'families' => [
                'required_if' => 'الرجاء تحديد العائلات',
            ],
            'volunteer_id' => [
                'exists' => 'الرجاء إختيار متطوع',
            ],
            'period' => [
                'numeric' => 'الرجاء إدخال الرقم بشكل صحيح',
                'min' => 'الرجاء إخال ققيمة اكبر من صفر',
            ],
        ],

        'show' => [
            'show' => 'عرض',
            'family_data' => 'بيانات العائلة',
            'order' => 'الطلب',
            'family' => [
                'family_info' => 'بيانات العائلة',
                'head_name' => 'رب الأسرة',
                'mobile' => 'رقم الهاتف',
                'members_count' => 'عدد أغراد الأسره',
            ],
            'address' => [
                'governorate' => 'المحافظة',
                'city' => 'المنطقة',
                'region' => 'القطعة',
                'street' => 'الشارع',
                'building_number' => 'رقم المبني',
                'floor_number' => 'رقم الدور',
                'apartment' => 'الشقة',
                'gada_number' => 'رقم الجاده',
                'ale_number' => 'رقم الألي',
            ],
            'charity' => [
                'mobile' => 'رقم الهاتف',
                'address' => 'العنوان',
            ],
            'volunteer' => 'المتطوع',
            'period' => 'الفتره الزمنيه (يوم)',
            'basket' => [
                'title' => 'العنوان',
                'qty' => 'الكمية',
            ],
            'total' => 'المجموع الكلي',
            'volunteer_note' => 'ملاحظات للمتطوع',
            'title' => 'تفاصيل الطلب',
        ],
    ],
];
