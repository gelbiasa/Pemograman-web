<!-- Jobsheet 12 Praktikum 1. Basic OOP Langkah 7  -->
<!-- contoh sederhana encapsulation dalam PHP -->
<?php
/*
// Definisi kelas Car
class Car
{
    // Properti model dan color dengan hak akses private agar hanya dapat diakses di dalam kelas ini
    private $model;
    private $color;

    // Konstruktor untuk inisialisasi model dan color saat pembuatan objek
    public function __construct($model, $color)
    {
        $this->model = $model; // Menginisialisasi properti model
        $this->color = $color; // Menginisialisasi properti color
    }

    // Metode untuk mengambil nilai properti model
    public function getModel()
    {
        return $this->model; // Mengembalikan nilai properti model
    }

    // Metode untuk mengatur nilai properti color
    public function setColor($color)
    {
        $this->color = $color; // Mengatur nilai properti color
    }

    // Metode untuk mengambil nilai properti color
    public function getColor()
    {
        return $this->color; // Mengembalikan nilai properti color
    }
}

// Membuat objek Car dengan model "Toyota" dan color "Blue"
$car = new Car("Toyota", "Blue");

// Menampilkan model mobil
echo "Model: " . $car->getModel() . "<br>";
// Menampilkan warna mobil
echo "Color: " . $car->getColor() . "<br>";

// Mengubah warna mobil menjadi "Red"
$car->setColor("Red");

// Menampilkan warna mobil yang telah diubah
echo "Updated Color: " . $car->getColor() . "<br>";
*/


// Jobsheet 12 Praktikum 1. Basic OOP Langkah 10  
// CONSTRUSTOR DAN DESTRUCTORS
class Car
{
    private $brand; // Properti untuk merepresentasikan merek mobil

    // Konstruktor untuk menciptakan objek mobil dengan merek tertentu
    public function __construct($brand)
    {
        echo "A new car is created. <br>"; // Menampilkan pesan bahwa mobil baru telah diciptakan
        $this->brand = $brand; // Menginisialisasi properti brand dengan nilai yang diberikan
    }

    // Metode untuk mendapatkan merek mobil
    public function getBrand()
    {
        return $this->brand; // Mengembalikan merek mobil
    }

    // Destruktor untuk menampilkan pesan ketika objek mobil dihancurkan
    public function __destruct()
    {
        echo "The car is destroyed. <br>"; // Menampilkan pesan bahwa mobil telah dihancurkan
    }
}

// Membuat objek Car dengan merek "Toyota"
$car = new Car("Toyota");

// Menampilkan merek mobil
echo "Brand: " . $car->getBrand() . "<br>"; // Menampilkan merek mobil yang telah diinisialisasi

?>