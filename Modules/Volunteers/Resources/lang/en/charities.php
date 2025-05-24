<?php

return [
    'volunteers' => [
        'form' => [
            'address' => 'Address',
            'email' => 'Email',
            'password' => 'Password',
            'whats_app' => 'whats app',
            'facebook' => 'facebook',
            'phone' => 'phone',
            'name' => 'Name',
            'image' => 'Image',
            'restore' => 'Restore from trash',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'Status',
            'type' => 'In footer',
            'tabs' => [
                'general' => 'General Info.',
                'seo' => 'SEO',
            ]
        ],
        'datatable' => [
            'amount_to_collect' => 'Amount to collect',
            'charity' => 'Charity',
            'created_at' => 'Created At',
            'date_range' => 'Search By Dates',
            'options' => 'Options',
            'status' => 'Status',
            'name' => 'Name',
            'image' => 'Image',
            'email' => 'Email',
            'phone' => 'Phone',
            'not_joined' => 'Not joined',
        ],
        'routes' => [
            'create' => 'Create Volunteers',
            'update' => 'Update Volunteer',
        ],
        'validation' => [
            'name' => [
                'required' => 'Please enter the name of Volunteer',
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
            'image' => [
                'image' => 'Please enter the file with type image',
                'mimes' => 'Please enter the file with type image',
            ],
        ],
    ],
];
