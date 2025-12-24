<?php

return [
    /*
    |--------------------------------------------------------------------------
    | SPPN Application Settings
    |--------------------------------------------------------------------------
    */

    'lapas' => [
        'name' => env('LAPAS_NAME', 'Lembaga Pemasyarakatan'),
        'code' => env('LAPAS_CODE', 'LP-001'),
        'address' => env('LAPAS_ADDRESS', ''),
        'phone' => env('LAPAS_PHONE', ''),
    ],

    'assessment' => [
        'auto_calculate' => env('ASSESSMENT_AUTO_CALCULATE', true),
        'require_approval' => env('ASSESSMENT_REQUIRE_APPROVAL', true),
        'days_per_month' => env('ASSESSMENT_DAYS_PER_MONTH', 31),

        'score_categories' => [
            'sangat_baik' => ['min' => 81, 'max' => 100],
            'baik' => ['min' => 61, 'max' => 80],
            'cukup' => ['min' => 41, 'max' => 60],
            'kurang' => ['min' => 21, 'max' => 40],
            'sangat_kurang' => ['min' => 0, 'max' => 20],
        ],
    ],

    'report' => [
        'date_format' => env('REPORT_DATE_FORMAT', 'd F Y'),
        'logo_path' => env('REPORT_LOGO_PATH', '/images/logo-kemenkumham.png'),
        'footer_text' => 'Kementerian Hukum dan HAK Asasi Manusia Republik Indonesia',
    ],

    'pagination' => [
        'per_page' => 15,
    ],

    'roles' => [
        'admin' => 'Administrator',
        'kepala_lapas' => 'Kepala Lembaga Pemasyarakatan',
        'kasubsi' => 'Kepala Sub Seksi Pembinaan',
        'wali_pemasyarakatan' => 'Wali Pemasyarakatan',
        'petugas' => 'Petugas Input',
    ],
];
