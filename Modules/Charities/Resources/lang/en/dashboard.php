<?php

return [
    'charities' => [
        'form' => [
            'address' => 'Address',
            'email' => 'Email',
            'password' => 'Password',
            'whats_app' => 'whats app',
            'facebook' => 'facebook',
            'phone' => 'phone',
            'logo' => 'Logo',
            'image' => 'Image',
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
            'amount_to_collect' => 'Amount to collect',
            'categories' => 'Categories',
            'country' => 'Country',
            'created_at' => 'Created At',
            'date_range' => 'Search By Dates',
            'options' => 'Options',
            'status' => 'Status',
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'image' => 'Image',
            'logo' => 'Logo',
            'email' => 'Email',
            'phone' => 'Phone',
            'families_count' => 'Families count',
        ],
        'routes' => [
            'create' => 'Create Charities',
            'index' => 'Charities',
            'update' => 'Update charity',
        ],
        'validation' => [
            'description' => [
                'required' => 'Please enter the description of charity',
                'unique' => 'This description is taken before',
            ],
            'title' => [
                'required' => 'Please enter the title of charity',
                'unique' => 'This title charity is taken before',
            ],
            'address' => [
                'required' => 'Please enter the address',
            ],
            'email' => [
                'required' => 'Please enter the Email',
                'email' => 'Please enter the Email',
                'unique' => 'This Email is already Exists',
            ],
            'password' => [
                'required' => 'Please enter the password',
                'min' => 'The password must be grater than 6 chars',
            ],
            'phone' => [
                'required' => 'Please enter the phone',
            ],
            'logo' => [
                'image' => 'Please enter the file with type image',
                'mimes' => 'Please enter the file with type image',
            ],
        ],
    ],
];
