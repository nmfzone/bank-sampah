<?php

return [

    'ctrl' => [
        'userMan' => [
            'index' => [
                'title' => 'Daftar Nasabah'
            ],
            'create' => [
                'title' => 'Tambah Nasabah',
            ],
            'store' => [
                'success' => 'Nasabah baru berhasil ditambahkan.',
            ],
            'update' => [
                'success' => [
                    'a' => 'Detail account berhasil diperbaharui.',
                    'b' => 'Data nasabah berhasil diperbaharui.',
                ],
            ],
            'destroy' => [
                'success' => 'Nasabah berhasil di hapus.'
            ],
        ],
        'user' => [
            'index' => [
                'title' => 'Detail Nasabah',
            ],
            'update' => [
                'success' => 'Data nasabah berhasil diperbaharui.',
            ],
        ],
        'transaction' => [

        ],
        'recapitulation' => [
            'index' => [
                'title' => 'Generate Rekapitulasi'
            ]
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
