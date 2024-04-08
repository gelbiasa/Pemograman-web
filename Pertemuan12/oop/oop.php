<!-- Jobsheet 12 Praktikum 1. Basic OOP Langkah 4 -->
<?php
// Pemanggilan metode startEngine() tanpa pembuatan objek $car1
// Membuat kelas Car
class Car
{
    // Properti untuk merepresentasikan merek mobil
    public $brand;

    // Metode untuk memulai mesin mobil
    public function startEngine()
    {
        echo "Engine started!"; // Menampilkan pesan bahwa mesin telah dinyalakan
    }
}

// Membuat objek $car dari kelas Car
$car = new Car();
$car -> brand = "Toyota"; // Menetapkan merek Toyota ke properti brand milik objek $car

// Membuat objek $car2 dari kelas Car
$car2 = new Car();
$car2 -> brand = "Honda"; // Menetapkan merek Honda ke properti brand milik objek $car2

// Memanggil metode startEngine() dari objek $car
$car -> startEngine(); // Menampilkan pesan bahwa mesin telah dinyalakan
echo $car2 -> brand; // Menampilkan merek mobil dari objek $car2
?>