<?php

return [

    'ctrl' => [
        'userMan' => [
            'index' => [
                'title' => 'Daftar User'
            ],
            'create' => [
                'title' => 'Tambah User',
            ],
            'store' => [
                'success' => 'User baru berhasil ditambahkan.',
            ],
            'update' => [
                'success' => [
                    'a' => 'Detail account berhasil diperbaharui.',
                    'b' => 'Data user berhasil diperbaharui.',
                ],
            ],
            'destroy' => [
                'success' => 'User berhasil di hapus.'
            ],
        ],
        'user' => [
            'index' => [
                'title' => 'Detail User',
            ],
            'update' => [
                'success' => 'Data user berhasil diperbaharui.',
            ],
        ],
        'auth' => [
            'registration' => [
                // 'success' => 'Selamat bergabung di Bank Sampah. Silahkan klik tautan yang dikirimkan ke email anda.',
                'success' => 'Selamat bergabung di Bank Sampah.',
            ],
            'email_verify' => [
                'success' => 'Selamat email anda telah terverifikasi.',
                'error' => 'Maaf kode konfirmasi yang anda masukkan tidak sesuai dengan user manapun.',
            ]
        ],
    ],

];
