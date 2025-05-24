<?php

return [
    'baskets' => [
        'form' => [
            'image' => 'Image',
            'price' => 'Price',
            'quantity' => 'Quantity',
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
            'description' => 'Description',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'image' => 'Image',
        ],
        'routes' => [
            'create' => 'Create Baskets',
            'index' => 'Baskets',
            'update' => 'Update basket',
        ],
        'validation' => [
            'description' => [
                'required' => 'Please enter the description of basket',
            ],
            'title' => [
                'required' => 'Please enter the title of basket',
                'unique' => 'This title basket is taken before',
            ],
            'price' => [
                'required' => 'Please enter the price of basket',
                'numeric' => 'Please enter the price of basket',
                'min' => 'basket price must by grater than 0',
            ],
            'quantity' => [
                'required' => 'Please enter the quantity of basket',
                'numeric' => 'Please enter the quantity of basket',
                'min' => 'basket quantity must by grater than 0',
            ],
        ],
    ],
];
