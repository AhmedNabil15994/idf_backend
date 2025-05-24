<?php

return [
    'families' => [
        'titles' => [
            'add_family' => 'اضافة اسرة متعففة',
            'charity_header' => 'الجمعيات أو الجهات الأخرى التي تقدم مساعدات للمستفيد أو عائلته',
            'members' => 'افراد الاسرة',
            'add_member' => 'اضف فرد آخر',
            'address' => 'العنوان',
            'other' => 'تفاصيل آخرى',
            'acknowledgment' => 'إقررا',
            'acknowledgment_dec' => 'أقر بصحة البيانات والمستندات المرسلة وأتحمل
                                    , كافة المسؤولية المترتبة على خلاف ذلك
                                    وأوافق على أن تستخدم الجمعية بياناتي لدراسة
                                    حالتي الاجتماعية والاستعلام عني وعن حالتي
                                    لدى جميع الجهات الحكومية والشركات
                                    .والمؤسسات الخيرية والبنوك
                                    مع العلم بأن الجمعية',
        ],

        'btn' => [
            'send_request' => 'ارسال الطلب',
        ],

        'form' => [
            'head_name' => 'اسم رب الأسرة',
            'head_gender' => ' حلة الأب',
            'nationality_id' => 'الجنسية',
            'phone' => 'رقم الهاتف',
            'job' => 'الوظيفة',
            'national_id' => 'رقم البطاقة',
            'nationality' => 'الجنسية',
            'current_salary' => 'الراتب الحالي',
            'breadwinner_Relationship' => 'صلة قرابة المعيل ',
            'family_breadwinner' => 'اسم معيل الاسرة في حال عدم وجود الاب',
            'gender' => 'الجنس',
            'male' => 'ذكر',
            'female' => 'انثي',
            'marital_status' => 'الحالة الإجتماعية',
            'married' => 'متذوج',
            'single' => 'أعزب',
            'widower' => 'أرمل',
            'divorce' => 'مطلق',
            'members_count' => 'عدد أفراد الأسرة',
            'name' => 'إسم',
            'governorate' => 'المحافظة',
            'city' => 'المنطقة',
            'region' => 'القطعه',
            'gada_number' => 'رقم الجاده',
            'ale_number' => 'رقم الألي',
            'street' => 'رقم الشارع ',
            'building_number' => 'رقم المبني',
            'floor_number' => 'رقم الدور',
            'apartment' => 'الشقة',
            'charities' => 'الجهة',
            'support_type' => 'نوع الدعم من الجهة',
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
