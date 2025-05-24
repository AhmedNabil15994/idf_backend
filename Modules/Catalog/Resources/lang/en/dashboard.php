<?php

return [
    'nationalities' => [
        'form' => [
            'description' => 'Description',
            'restore' => 'Restore from trash',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'Status',
            'title' => 'Title',
            'type' => 'In footer',
            'tabs' => [
                'general' => 'General Info.',
                'seo' => 'SEO',
            ]
        ],
        'datatable' => [
            'created_at' => 'Created At',
            'date_range' => 'Search By Dates',
            'options' => 'Options',
            'status' => 'Status',
            'title' => 'Title',
        ],
        'routes' => [
            'create' => 'Create nationalities',
            'index' => 'nationalities',
            'update' => 'Update nationality',
        ],
        'validation' => [
            'description' => [
                'required' => 'Please enter the description of nationality',
            ],
            'title' => [
                'required' => 'Please enter the title of nationality',
                'unique' => 'This title nationality is taken before',
            ],
        ],
    ],
    'partners' => [
        'form' => [
            'description' => 'Description',
            'restore' => 'Restore from trash',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'Status',
            'link' => 'Link',
            'image' => 'Image',
            'type' => 'In footer',
            'tabs' => [
                'general' => 'General Info.',
                'seo' => 'SEO',
            ]
        ],
        'datatable' => [
            'created_at' => 'Created At',
            'date_range' => 'Search By Dates',
            'options' => 'Options',
            'status' => 'Status',
            'link' => 'Link',
            'image' => 'Image',
        ],
        'routes' => [
            'create' => 'Create partners',
            'index' => 'partners',
            'update' => 'Update partner',
        ],
        'validation' => [
            'link' => [
                'required' => 'Please enter the link of partner',
            ],
            'image' => [
                'mimes' => 'The mime type is not Valid',
            ],
        ],
    ],
    'statistics' => [
        'form' => [
            'title' => 'Title',
            'sub_title' => 'Sub Title',
            'value' => 'Value',
            'restore' => 'Restore from trash',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'Status',
            'link' => 'Link',
            'image' => 'Image',
            'type' => 'In footer',
            'tabs' => [
                'general' => 'General Info.',
                'seo' => 'SEO',
            ]
        ],
        'datatable' => [
            'created_at' => 'Created At',
            'date_range' => 'Search By Dates',
            'options' => 'Options',
            'status' => 'Status',
            'title' => 'Title',
            'sub_title' => 'Sub Title',
            'value' => 'Value',
        ],
        'routes' => [
            'create' => 'Create Statistics',
            'index' => 'Statistics',
            'update' => 'Update Statistics',
        ],
        'validation' => [
            'link' => [
                'required' => 'Please enter the link of Statistics',
            ],
            'image' => [
                'mimes' => 'The mime type is not Valid',
            ],
        ],
    ],
    'charters' => [
        'form' => [
            'title' => 'Title',
            'btn_title' => 'Button Title',
            'description' => 'Description',
            'status' => 'Status',
            'tabs' => [
                'general' => 'General Info.',
            ]
        ],
        'datatable' => [
            'created_at' => 'Created At',
            'date_range' => 'Search By Dates',
            'options' => 'Options',
            'status' => 'Status',
            'title' => 'Title',
            'btn_title' => 'Button Title',
            'description' => 'Description',
        ],
        'routes' => [
            'create' => 'Create Charters',
            'index' => 'Charters',
            'update' => 'Update Charters',
        ],
        'validation' => [
            'link' => [
                'required' => 'Please enter the link of Charters',
            ],
            'image' => [
                'mimes' => 'The mime type is not Valid',
            ],
        ],
    ],
    'religions' => [
        'form' => [
            'description' => 'Description',
            'restore' => 'Restore from trash',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'Status',
            'title' => 'Title',
            'type' => 'In footer',
            'tabs' => [
                'general' => 'General Info.',
                'seo' => 'SEO',
            ]
        ],
        'datatable' => [
            'created_at' => 'Created At',
            'date_range' => 'Search By Dates',
            'options' => 'Options',
            'status' => 'Status',
            'title' => 'Title',
        ],
        'routes' => [
            'create' => 'Create religions',
            'index' => 'religions',
            'update' => 'Update religion',
        ],
        'validation' => [
            'description' => [
                'required' => 'Please enter the description of religion',
            ],
            'title' => [
                'required' => 'Please enter the title of religion',
                'unique' => 'This title religion is taken before',
            ],
        ],
    ],

    'home-cards' => [
        'form' => [
            'title' => 'Title',
            'link' => 'Target Link',
            'sub_title' => 'Sub Title',
            'color' => 'Color',
            'restore' => 'Restore from trash',
            'status' => 'Status',
            'tabs' => [
                'general' => 'General Info.',
            ]
        ],
        'datatable' => [
            'created_at' => 'Created At',
            'date_range' => 'Search By Dates',
            'options' => 'Options',
            'status' => 'Status',
            'title' => 'Title',
            'sub_title' => 'Sub Title',
            'color' => 'Color',
        ],
        'routes' => [
            'create' => 'Create Home Cards',
            'index' => 'Home Cards',
            'update' => 'Update Home Cards',
        ],
    ],

    'prices' => [
        'form' => [
            'price' => 'Price',
            'status' => 'Status',
            'sort' => 'Sort',
            'tabs' => [
                'general' => 'General Info.',
            ]
        ],
        'datatable' => [
            'created_at' => 'Created At',
            'date_range' => 'Search By Dates',
            'options' => 'Options',
            'status' => 'Status',
            'price' => 'Price',
            'sort' => 'Sort',
        ],
        'routes' => [
            'create' => 'Create Price',
            'index' => 'Prices',
            'update' => 'Update Home Cards',
        ],
    ],
];
