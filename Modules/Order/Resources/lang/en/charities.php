<?php

return [
    'orders' => [
        'form' => [
            'families' => 'Families',
            'all' => 'All',
            'select_families' => 'Select Families',
            'volunteer' => 'Volunteer',
            'period' => 'Period (days)',
            'volunteer_note' => 'Volunteer Note',
            'restore' => 'Restore from trash',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'Status',
            'title' => 'Title',
            'pending' => 'Pending',
            'delivered' => 'Delivered',
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
            'volunteer_name' => 'Volunteer name',
            'family_leader_name' => 'Family leader name',
            'family_members_count' => 'Family members count',
            'period' => 'Period',
            'baskets_count' => 'Baskets count',
            'days' => 'days',
            'status_name' => [
                'pending' => 'pending',
                'delivered' => 'delivered',
            ],
        ],
        'routes' => [
            'create' => 'Create Orders',
            'index' => 'Orders',
            'update' => 'Update Order',
        ],
        'validation' => [
            'families_type' => [
                'required' => 'Please select value',
            ],
            'families' => [
                'required_if' => 'Please select families',
            ],
            'volunteer_id' => [
                'exists' => 'Please select valid value',
            ],
            'period' => [
                'numeric' => 'Please enter numeric value',
                'min' => 'Please enter value grater than 0',
            ],
            'status' => [
                'required' => 'Please select value',
            ],
        ],
        'show' => [
            'show' => 'show',
            'family_data' => 'family data',
            'order' => 'order',
            'family' => [
                'family_info' => 'family information',
                'head_name' => 'father name',
                'mobile' => 'mobile',
                'members_count' => 'family members count',
            ],
            'address' => [
                'governorate' => 'governorate',
                'city' => 'city',
                'region' => 'region',
                'street' => 'street',
                'building_number' => 'building number',
                'floor_number' => 'floor number',
                'apartment' => 'apartment',
                'gada_number' => 'gada number',
                'ale_number' => 'ale number',
            ],
            'charity' => [
                'mobile' => 'mobile',
                'address' => 'address',
            ],
            'volunteer' => 'volunteer',
            'period' => 'period',
            'basket' => [
                'title' => 'title',
                'qty' => 'qty',
            ],
            'total' => 'total',
            'volunteer_note' => 'volunteer note',
            'title' => 'show order',
        ],
    ],
];
