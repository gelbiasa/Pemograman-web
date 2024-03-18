<?php
// Array menu dengan struktur bertingkat
$menu = [
    [
        "nama" => "Beranda"
    ],
    [
        "nama" => "Berita",
        "subMenu" => [
            [
                "nama" => "Wisata",
                "subMenu" => [
                    [
                        "nama" => "Pantai"
                    ],
                    [
                        "nama" => "Gunung"
                    ]
                ]
            ],
            [
                "nama" => "Kuliner"
            ],
            [
                "nama" => "Hiburan"
            ]
        ]
    ],
    [
        "nama" => "Tentang"
    ],
    [
        "nama" => "Kontak"
    ]
];

// Fungsi untuk menampilkan menu bertingkat
function tampilkanMenuBertingkat(array $menu, $indentation = '')
{
    echo "<ul>";
    // Iterasi melalui setiap item menu
    foreach ($menu as $item) {
        // Menampilkan item menu dengan indentation yang sesuai
        echo "<li>{$indentation}{$item['nama']}";
        // Jika item menu memiliki submenu dan tipe datanya adalah array
        if (isset($item['subMenu']) && is_array($item['subMenu'])) {
            // Panggil fungsi ini sendiri untuk menampilkan submenu dengan indentation yang lebih dalam
            tampilkanMenuBertingkat($item['subMenu'], $indentation . '          ');
        }
        echo "</li>";
    }
    echo "</ul>";
}
// Memanggil fungsi untuk menampilkan menu bertingkat
tampilkanMenuBertingkat($menu);
?>
