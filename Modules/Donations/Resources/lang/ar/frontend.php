<?php

return [
    'messages' => [
        'redirect_to_get_way' => 'جاري تحويلك على صفحة الدفع' ,
        "fail_daily" => "يجب ان يكون التاريخ اقل من خمس ايام من تاريخ اليوم"
    ],
    'donate_resources' => [
        'title' => 'طلب استلام عيني',
        'make_request' => 'انشاء طلب استلام عيني',
        'btn' => [
            'send_request' => 'ارسال الطلب'
        ],
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
        'validation' => [
            'name' => [
                'required' => 'الرجاء إدخال قيمة',
            ],
            'phone' => [
                'required' => 'الرجاء إدخال قيمة',
                'numeric' => 'الرجاء إدخال الرقم بشكل صحيح',
            ],
            'item_types' => [
                'required' => 'الرجاء إختيار قيمة',
            ],
            'quantities' => [
                'required' => 'الرجاء إدخال قيمة',
                'numeric' => 'الرجاء إدخال الرقم بشكل صحيح',
                'min' => ' لا يمكنك إخال قيمة أقل من  :min',
            ],
            'categories' => [
                'required' => 'الرجاء إدخال قيمة',
            ],
        ],
    ],
    'donation' => [
        'title' => 'Request to Donate Resources',
        'make_request' => 'Make Request to Donate Resources',
        'btn' => [
            'donate' => 'تبرع'
        ],
        'form' => [
            'amount' => 'المبلغ',
            'enter_donate_amount' => 'أدخل قيمة التبرع',
        ],
        'validation' => [
            'amount' => [
                'required' => 'المبلغ مطلوب',
                'min' => 'اقل مبلغ يمكن إدخاله هو :min',
            ],
        ],
    ],
    'recurring_donations' => [
        'title' => 'الاستقطاع الشهري',
        'title_day' => 'الاستقطاع ',
        'make_request' => 'Make Request to Donate Resources',
        'btn' => [
            'donate' => 'تبرع'
        ],
        'form' => [
            'amount' => 'المبلغ',
            'enter_donate_amount' => 'أدخل قيمة التبرع',
        ],
        'validation' => [
            'amount' => [
                'required' => 'المبلغ مطلوب',
                'min' => 'اقل مبلغ يمكن إدخاله هو :min',
            ],
        ],
    ],
];
