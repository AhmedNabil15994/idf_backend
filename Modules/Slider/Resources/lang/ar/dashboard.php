<?php

return [
    'sliders' => [
        'create'    => [
            'form'  => [
                'categories'    => 'الاقسام',
            ],
        ],
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'image'         => 'الصورة',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            'title'         => 'العنوان',
        ],
        'form'      => [
            'add_dates' => 'تحديد فتره زمنيه',
            'description'           => 'الوصف',
            'image'                 => 'الصورة',
            'link_type'                 => 'نوع الرابط',
            'external_link'                 => 'رابط خارجي',
            'project'                 => 'مشروع',
            'projects'                 => 'المشاريع',
            'status'                 => 'الحالة',
            'link'                 => 'الرابط',
            'order'                 => 'الترتيب',
            'start_date'                 => 'يبدأ في',
            'end_date'                 => 'الانتهاء في',
            'instagram'             => 'انستجرام',
            'is_employees_type'     => 'خدمة الموظفين',
            'is_health_care'        => 'خدمة العناية الصحية',
            'is_house_keeping_type' => 'خدمة العمالة المنزلية',
            'lang'                  => 'longitude',
            'lat'                   => 'lattitude',
            'main_category'         => 'مشروع رئيسي',
            'main_project'          => 'الاقسام الرئيسية',
            'meta_description'      => 'Meta Description',
            'meta_keywords'         => 'Meta Keywords',
            'phone'                 => 'رقم الهاتف',
            'tabs'                  => [
                'category_level'    => 'مستوى السلايدر',
                'project_level'     => 'مستوى القسم',
                'general'           => 'بيانات عامة',
                'seo'               => 'SEO',
            ],
            'title'                 => 'عنوان',
            'user'                  => 'المستخدم',
            'website'               => 'رابط الموقع الالكتروني',
        ],
        'routes'    => [
            'create'    => 'اضافة السلايدر',
            'index'     => 'السلايدر',
            'update'    => 'تعديل السلايدر',
        ],
        'validation' => [
            'type' => [
                'required' => 'من فضلك ادخل نوع الرابط',
                'in' => 'من فضلك ادخل نوع الرابط',
            ],
            'project' => [
                'required' => 'من فضلك اختر الشركه',
            ],
            'link' => [
                'required' => 'من فضلك ادخل الرابط',
            ],
        ],
    ],
];
