<?php

return [
    'projects' => [
        'form' => [
            'amount_to_collect' => 'Amount to collect',
            'categories' => 'Categories',
            'country' => 'Country',
            'image' => 'Image',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'restore' => 'Restore from trash',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'Status',
            'title' => 'Title',
            'description' => 'Description',
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
            'total_donation' => 'Total Donation',
        ],
        'routes' => [
            'create' => 'Create Baskets',
            'index' => 'Baskets',
            'update' => 'Update project',
        ],
        'validation' => [
            'description' => [
                'required' => 'Please enter the description of project',
            ],
            'title' => [
                'required' => 'Please enter the title of project',
                'unique' => 'This title project is taken before',
            ],
            'country_id' => [
                'required' => 'Please select country',
            ],
            'categories' => [
                'required' => 'Please select categories',
            ],
            'amount_to_collect' => [
                'numeric' => 'Please inter the Amount to collect',
                'min' => 'Amount to collect must be grater than Zero',
            ],
        ],
    ],
];
