<?php

return [
    'messages' => [
        'redirect_to_get_way' => 'Wait for Redirect to get way' ,
        "fail_daily" => "Date must be less than five days from today's date"
    ],
    'donate_resources' => [
        'title' => 'Request to Donate Resources',
        'make_request' => 'Make Request to Donate Resources',
        'btn' => [
            'send_request' => 'Send Request'
        ],
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
    'donation' => [
        'title' => 'Request to Donate Resources',
        'make_request' => 'Make Request to Donate Resources',
        'btn' => [
            'donate' => 'Donate'
        ],
        'form' => [
            'amount' => 'Amount',
            'enter_donate_amount' => 'Enter Donate Amount',
        ],
        'validation' => [
            'amount' => [
                'required' => 'The Field is Required',
                'min' => 'The minimum value is :min',
            ],
        ],
    ],
    'recurring_donations' => [
        'title' => 'Recurring donations',
        'make_request' => 'Make Request to Donate Resources',
        'btn' => [
            'donate' => 'Donate'
        ],
        'form' => [
            'amount' => 'Amount',
            'enter_donate_amount' => 'Enter Donate Amount',
        ],
        'validation' => [
            'amount' => [
                'required' => 'The Field is Required',
                'min' => 'The minimum value is :min',
            ],
        ],
    ],
];
