<?php

return [
    'families' => [
        'form' => [
            'head_name' => 'Head of family name',
            'phone' => 'Phone',
            'national_id' => 'National ID',
            'nationality' => 'Nationality',
            'current_salary' => 'Current salary',
            'gender' => 'Gender',
            'male' => 'Male',
            'female' => 'Female',
            'marital_status' => 'Marital status',
            'married' => 'Married',
            'single' => 'Single',
            'widower' => 'Widower',
            'divorce' => 'Divorce',
            'members_count' => 'number of family members',
            'name' => 'Beneficiary Name',
            'governorate' => 'Governorate',
            'city' => 'City',
            'region' => 'Region',
            'gada_number' => 'Gada number',
            'ale_number' => 'Ale number',
            'street' => 'Street',
            'building_number' => 'Building Number',
            'floor_number' => 'Floor Number',
            'apartment' => 'Apartment',
            'charities' => 'Charities',
            'charity' => 'Charity',
            'attachments' => 'attachments',
            'religion' => 'Religion',
            'support_type' => 'Support Type',
            'restore' => 'Restore from trash',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'Status',
            'title' => 'Title',
            'type' => 'In footer',
            'baskets' => 'Baskets',
            'basket_name' => 'Basket name',
            'baskets_numbers' => 'Baskets Numbers',
            'tabs' => [
                'general' => 'General Info.',
                'family_members' => 'Family Members Info.',
                'address' => 'Address Info.',
                'charities' => 'Charities',
                'baskets' => 'Baskets',
                'attachments' => 'Attachments',
                'seo' => 'SEO',
            ]
        ],

        'validation' => [
            'head_name' => [
                'required' => 'Please enter the Head of family name',
            ],
            'head_phone' => [
                'required' => 'Please enter the Phone',
            ],
            'head_national_id' => [
                'required' => 'Please enter the National ID',
                'unique' => 'This  National ID already exists',
            ],
            'head_nationality_id' => [
                'required' => 'Please select the Nationality',
            ],
            'head_religion_id' => [
                'required' => 'Please select the Religion',
            ],
            'head_current_salary' => [
                'required' => 'Please enter the Current salary',
            ],
            'head_gender' => [
                'required' => 'Please select the Gender',
            ],
            'head_marital_status' => [
                'required' => 'Please select the Marital status',
            ],
            'members_count' => [
                'required' => 'Please enter the number of family members',
                'min' => 'family members Number must be grater than zero',
            ],
            'members' => [
                'not_equal' => 'The members data not equal number of family members',
            ],
            'members_names' => [
                'required' => 'Please enter the Beneficiary Name',
            ],
            'members_national_ids' => [
                'required' => 'Please enter the members National IDS',
                'unique' => 'This  National ID already exists',
            ],
            'governorate' => [
                'required' => 'Please enter the governorate',
            ],
            'city' => [
                'required' => 'Please enter the city',
            ],
            'region_id' => [
                'required' => 'Please enter the region',
            ],
            'gada_number' => [
                'required' => 'Please enter the Gada number',
            ],
            'ale_number' => [
                'required' => 'Please enter the Ale number',
            ],
            'street' => [
                'required' => 'Please enter the Street',
            ],
            'building_number' => [
                'required' => 'Please enter the Building Number',
            ],
            'floor_number' => [
                'required' => 'Please enter the Floor Number',
            ],
            'apartment' => [
                'required' => 'Please enter the Apartment',
            ],
            'charities' => [
                'exists' => 'Please enter the Charities',
            ],
            'attachments' => [
                'max' => 'The max size of file is 10 MB',
                'mimes' => 'The file mime not supported',
            ],
        ],
    ],
];
