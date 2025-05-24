<?php

return [
    'item_types' => [
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
            'create' => 'Create Item Types',
            'index' => 'Item Types',
            'update' => 'Update Item Type',
        ],
        'validation' => [
            'description' => [
                'required' => 'Please enter the description of Item Type',
            ],
            'title' => [
                'required' => 'Please enter the title of Item Type',
                'unique' => 'This title Item Type is taken before',
            ],
        ],
    ],
    'donors' => [
        'form' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'phone',
            'status' => 'Status',
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
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'phone',
        ],
        'routes' => [
            'create' => 'Create Donors',
            'index' => 'Donors',
            'update' => 'Update donors',
        ],

        'validation' => [
            'name' => [
                'required' => 'Please enter the name',
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
        ],
    ],

    'donate_resources' => [
        'form' => [
            'description' => 'Description',
            'restore' => 'Restore from trash',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'phone' => 'Phone',
            'name' => 'Name',
            'categories' => 'Categories',
            'quantity' => 'Quantity',
            'item_type' => 'Item Type',
            'type' => 'In footer',
            'tabs' => [
                'general' => 'General Info.',
                'items' => 'items',
                'seo' => 'SEO',
            ]
        ],
        'datatable' => [
            'created_at' => 'Created At',
            'date_range' => 'Search By Dates',
            'options' => 'Options',
            'Phone' => 'Phone',
            'name' => 'Name',
            'categories' => 'Categories',
            'quantity' => 'Quantity',
            'item_type' => 'Item Type',
        ],
        'routes' => [
            'create' => 'Create Donate Resources',
            'index' => 'Donate Resources',
            'update' => 'Update Donate Resource',
        ],
        'validation' => [
            'name' => [
                'required' => 'The Field is Required',
            ],
            'phone' => [
                'required' => 'The Field is Required',
                'numeric' => 'Input must be numeric',
            ],
            'item_types' => [
                'required' => 'The Field is Required',
            ],
            'quantities' => [
                'required' => 'The Field is Required',
                'numeric' => 'Input must be numeric',
                'min' => 'The Min value you can enter is :min',
            ],
            'categories' => [
                'required' => 'The Field is Required',
            ],
        ],
    ],

    'donations' => [
        'datatable' => [
            'payment_success' => 'Success',
            'payment_failed' => 'Sailed',
            'created_at' => 'Created At',
            'date_range' => 'Search By Dates',
            'options' => 'Options',
            'status' => 'Status',
            'total' => 'Total',
            'pending' => 'Pending',
            'helpful' => 'Helpful',
            'show' => 'Show',
            'donor_email' => 'Email',
            'project' => 'Project Name',
            'donor_name' => 'Donor name',
            'donor_mobile' => 'Donor Mobile',
            'payment_method' => 'Payment Method',

        ],
        'modal' => [
            'show_donation' => 'Show Donation',
            'created_at' => 'Created At',
            'status' => 'Status',
            'total' => 'Total',
            'payment_method' => 'Payment method',
            'donor' => 'Donor',
            'donation_data' => 'Donation Data',
            'donation' => 'Donation',
            'donor_info' => 'Donor Info',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'donation_content' => 'Donation Content',
            'type' => 'Type',
            'title' => 'Title',
            'amount' => 'Amount',
            'donor_info_not_entered' => 'Donor not entered his Data',
            'projects' => 'Projects',
            'food_baskets' => 'Food baskets',
            'data_not_found' => 'Data not found',

        ],
        'routes' => [
            'create' => 'Create Donations',
            'index' => 'Donations',
            'update' => 'Update Donation',
        ],
        'validation' => [
            'description' => [
                'required' => 'Please enter the description of Donation',
            ],
            'title' => [
                'required' => 'Please enter the title of Donation',
                'unique' => 'This title Donation is taken before',
            ],
        ],
    ],
];
