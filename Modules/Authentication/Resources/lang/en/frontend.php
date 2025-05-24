<?php

return [
    'forget_password' => [
        'mail' => [
            'subject' => 'Reset Password',
        ],
        'messages' => [
            'success' => 'Reset Password Send Successfully',
        ],
    ],
    'login' => [
        'donor_login' => 'Donor Login',
        'donor_login_welcome' => 'Welcome, you can log in from here',
        'donor_register' => 'Donor Register',
        'donor_welcome' => 'Welcome, you can create a new account from here',
        'title' => 'Login and Register',
        'message' => [
            'login_success' => 'Login success'
        ],
        'form' => [
            'btn' => [
                'login' => 'Login Now',
                'forget_password' => 'Forget Password',
            ],
            'email' => 'ِEmail address',
            'password' => 'Password',
            'remember_me' => 'Remember Me',
        ],
        'routes' => [
            'index' => 'Login',
        ],
        'validations' => [
            'email' => [
                'email' => 'Please add correct email format',
                'required' => 'Please add your email address',
            ],
            'failed' => 'These credentials do not match our records.',
            'password' => [
                'min' => 'Password must be more than 6 characters',
                'required' => 'The password field is required',
            ],
        ],
    ],
    'register' => [
        'message' => [
            'registered_success' => 'You are registered'
        ],
        'title' => 'Login and Register',
        'mail' => [
            'subject' => 'Register Confirmation',
            'button_content' => 'Confirmation Account',
            'header' => 'You are receiving this email to confirm your account.',
        ],
        'form' => [
            'btn' => [
                'register' => 'New Account',
            ],
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'ِEmail address',
            'password' => 'Password',
            'password_confirmation' => 'Password Confirmation',
        ],
        'routes' => [
            'index' => 'Login',
        ],
        'validations' => [
            'email' => [
                'email' => 'Please add correct email format',
                'unique' => 'Email already Taken',
                'required' => 'Please add your email address',
            ],
            'name' => [
                'required' => 'Please add your Name',
            ],
            'phone' => [
                'required' => 'Please add your Phone',
                'unique' => 'Phone  already Taken',
                'digits_between' => 'Phone Must be digits between 8 Numbers',
            ],
            'failed' => 'These credentials do not match our records.',
            'password' => [
                'min' => 'Password must be more than 6 characters',
                'required' => 'The password field is required',
                'confirmed' => 'The password and password confirmation not matched',
            ],
        ],
    ],
    'reset' => [
        'mail' => [
            'button_content' => 'Reset Your Password',
            'header' => 'You are receiving this email because we received a password reset request for your account.',
            'subject' => 'Reset Password',
        ],
        'title' => 'Reset Password',
        'reset' => 'Reset',
        'send_verification' => 'Send Verification',
        'validation' => [
            'email' => [
                'email' => 'Please enter correct email format',
                'exists' => 'This email not exists',
                'required' => 'The email field is required',
            ],
            'password' => [
                'min' => 'Password must be more than 6 characters',
                'required' => 'The password field is required',
            ],
            'token' => [
                'exists' => 'This token expired',
                'required' => 'The token field is required',
            ],
        ],
    ],
];
