<?php

return [
    'volunteers' => [
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
            'name' => 'Name',
            'd_o_b' => 'Date Of Birth',
        ],
        'routes' => [
            'create' => 'Create Charities',
            'index' => 'Charities',
            'update' => 'Update charity',
        ],
        'validation' => [
            'name' => [
                'required' => 'Please enter the Name',
            ],
            'd_o_b' => [
                'required' => 'Please enter the Date Of Birth',
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
