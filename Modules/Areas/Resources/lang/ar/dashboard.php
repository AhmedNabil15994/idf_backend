<?php

return [
    'countries' => [
        'form'  => [
            'description'       => 'الوصف',
            'restore'           => 'استرجاع من الحذف',
            'meta_description'  => 'Meta Description',
            'meta_keywords'     => 'Meta Keywords',
            'status'            => 'الحالة',
            'title'             => 'عنوان الدولة',
            'type'              => 'في تذيل الدولة',
            'tabs'  => [
              'general'   => 'بيانات عامة',
              'seo'               => 'SEO',
            ],
        ],
        'routes'    => [
          'create'  => 'اضافة الدول',
          'index'   => 'الدول',
          'update'  => 'تعديل الدولة',
        ],
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            'title'         => 'العنوان',
        ],
        'validation'=> [
            'description'   => [
                'required'  => 'من فضلك ادخل وصف الدولة',
            ],
            'title'         => [
                'required'  => 'من فضلك ادخل عنوان الدولة',
                'unique'    => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],
    'governorates' => [
        'form'  => [
            'description'       => 'الوصف',
            'restore'           => 'استرجاع من الحذف',
            'meta_description'  => 'Meta Description',
            'meta_keywords'     => 'Meta Keywords',
            'status'            => 'الحالة',
            'title'             => 'عنوان المحافظة',
            'type'              => 'في تذيل المحافظة',
            'tabs'  => [
              'general'   => 'بيانات عامة',
              'seo'               => 'SEO',
            ],
        ],
        'routes'    => [
          'create'  => 'اضافة المحافظات',
          'index'   => 'المحافظات',
          'update'  => 'تعديل المحافظة',
        ],
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            'title'         => 'العنوان',
        ],
        'validation'=> [
            'description'   => [
                'required'  => 'من فضلك ادخل وصف المحافظة',
            ],
            'title'         => [
                'required'  => 'من فضلك ادخل عنوان المحافظة',
                'unique'    => 'هذا العنوان تم ادخالة من قبل',
            ],
        ],
    ],
    'cities' => [
        'form'  => [
            'governorate'       => 'المحافظة',
            'description'       => 'الوصف',
            'restore'           => 'استرجاع من الحذف',
            'meta_description'  => 'Meta Description',
            'meta_keywords'     => 'Meta Keywords',
            'status'            => 'الحالة',
            'title'             => 'عنوان المنطقة',
            'type'              => 'في تذيل المنطقة',
            'tabs'  => [
              'general'   => 'بيانات عامة',
              'seo'               => 'SEO',
            ],
        ],
        'routes'    => [
          'create'  => 'اضافة المناطق',
          'index'   => 'المناطق',
          'update'  => 'تعديل المنطقة',
        ],
        'datatable' => [
            'governorate'       => 'المحافظة',
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            'title'         => 'العنوان',
        ],
        'validation'=> [
            'description'   => [
                'required'  => 'من فضلك ادخل وصف المنطقة',
            ],
            'title'         => [
                'required'  => 'من فضلك ادخل عنوان المنطقة',
                'unique'    => 'هذا العنوان تم ادخالة من قبل',
            ],
            'governorate_id'         => [
                'required'  => 'من فضلك إختر  المحافظة',
            ],
        ],
    ],
    'regions' => [
        'form'  => [
            'city'       => 'المنطقة',
            'description'       => 'الوصف',
            'restore'           => 'استرجاع من الحذف',
            'meta_description'  => 'Meta Description',
            'meta_keywords'     => 'Meta Keywords',
            'status'            => 'الحالة',
            'title'             => 'عنوان القطعه',
            'type'              => 'في تذيل القطعه',
            'tabs'  => [
              'general'   => 'بيانات عامة',
              'seo'               => 'SEO',
            ],
        ],
        'routes'    => [
          'create'  => 'اضافة القطع',
          'index'   => 'القطع',
          'update'  => 'تعديل القطعه',
        ],
        'datatable' => [
            'city'       => 'المدن',
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            'title'         => 'العنوان',
        ],
        'validation'=> [
            'description'   => [
                'required'  => 'من فضلك ادخل وصف القطع',
            ],
            'title'         => [
                'required'  => 'من فضلك ادخل عنوان القطع',
                'unique'    => 'هذا العنوان تم ادخالة من قبل',
            ],
            'city_id'         => [
                'required'  => 'من فضلك إختر  المدينة',
            ],
        ],
    ],
];
