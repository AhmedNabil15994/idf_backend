<?php

return [
    'charities' => [
        'by_registering_you_agree_to' => 'By registering, you agree to',
        'btn' =>[
            'ask_join' => 'Ask Join',
            'project_charter' => 'Project charter',
        ],
        'form' => [
            'address' => 'Address',
            'email' => 'Email',
            'password' => 'Password',
            'whats_app' => 'whats app',
            'facebook' => 'facebook',
            'phone' => 'phone',
            'contact_name' => 'Contact Name',
            'charity_name' => 'Charity Name',
        ],
        'routes' => [
            'create' => 'Create Charities',
            'index' => 'Charities',
            'update' => 'Update charity',
        ],
        'validation' => [
            'name' => [
                'required' => 'Please enter the Contact Name',
            ],
            'charity_name' => [
                'required' => 'Please enter the Charity Name of charity',
                'unique' => 'This title Charity Name is taken before',
            ],
            'email' => [
                'required' => 'Please enter the Email',
                'email' => 'Please enter the Email',
                'unique' => 'This Email is already Exists',
            ],
            'phone' => [
                'required' => 'Please enter the phone',
                'unique' => 'This Phone is already Exists',
            ],
        ],
    ],
];
