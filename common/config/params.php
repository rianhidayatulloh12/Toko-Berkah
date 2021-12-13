<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    'params' => [
        'maskMoneyOptions' => [
            'prefix' => 'Rp. ',
            'suffix' => ' c',
            'affixesStay' => true,
            'thousands' => ',',
            'decimal' => '.',
            'precision' => 2,
            'allowZero' => false,
            'allowNegative' => false,
        ]
    ]
];
