<!-- Jobsheet 12 Praktikum 1. Basic OOP Langkah 8  -->
<!-- Contoh Sederhana Abstraksi dalam PHP -->
<?php
/*
// Definisi kelas abstrak Shape
abstract class Shape
{
    abstract public function calculateArea(); // Metode abstrak untuk menghitung luas area, harus diimplementasikan oleh kelas turunannya
}

// Definisi kelas Circle yang merupakan turunan dari kelas Shape
class Circle extends Shape
{
    private $radius; // Properti untuk menyimpan nilai radius lingkaran

    // Konstruktor untuk menginisialisasi nilai radius saat pembuatan objek
    public function __construct($radius)
    {
        $this->radius = $radius;
    }

    // Implementasi metode calculateArea() dari kelas Shape untuk menghitung luas area lingkaran
    public function calculateArea()
    {
        return pi() * pow($this->radius, 2); // Menggunakan formula luas lingkaran: pi * r^2
    }
}

// Definisi kelas Rectangle yang merupakan turunan dari kelas Shape
class Rectangle extends Shape
{
    private $width; // Properti untuk menyimpan nilai lebar persegi panjang
    private $height; // Properti untuk menyimpan nilai tinggi persegi panjang

    // Konstruktor untuk menginisialisasi nilai lebar dan tinggi saat pembuatan objek
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    // Implementasi metode calculateArea() dari kelas Shape untuk menghitung luas area persegi panjang
    public function calculateArea()
    {
        return $this->width * $this->height; // Menghitung luas area persegi panjang: panjang * lebar
    }
}

// Membuat objek Circle dengan radius 5
$circle = new Circle(5);
// Membuat objek Rectangle dengan lebar 4 dan tinggi 6
$rectangle = new Rectangle(4, 6);

// Menampilkan luas area lingkaran
echo "Area of Circle: " . $circle->calculateArea() . "<br>";
// Menampilkan luas area persegi panjang
echo "Area of Rectangle: " . $rectangle->calculateArea() . "<br>";
*/

// Jobsheet 12 Praktikum 1. Basic OOP Langkah 9
// Contoh Penggunaan Interface dalam PHP
interface Shape {
    public function calculateArea();
}

// Definisi antarmuka Color yang memiliki satu metode getColor()
interface Color
{
    public function getColor();
}

// Definisi kelas Circle yang mengimplementasikan antarmuka Shape dan Color
class Circle implements Shape, Color {
    private $radius; // Properti untuk menyimpan nilai radius lingkaran
    private $color; // Properti untuk menyimpan warna lingkaran

    // Konstruktor untuk menginisialisasi nilai radius dan warna saat pembuatan objek
    public function __construct($radius, $color)
    {
        $this -> radius = $radius;
        $this -> color = $color;
    }

    // Implementasi metode calculateArea() dari antarmuka Shape untuk menghitung luas area lingkaran
    public function calculateArea()
    {
        return pi() * pow($this -> radius, 2); // Menggunakan formula luas lingkaran: pi * r^2
    }

    // Implementasi metode getColor() dari antarmuka Color untuk mendapatkan warna lingkaran
    public function getColor()
    {
        return $this -> color;
    }
}

// Membuat objek Circle dengan radius 5 dan warna "Blue"
$circle = new Circle(5, "Blue");

// Menampilkan luas area lingkaran
echo "Area of Circle: " . $circle -> calculateArea() . "<br>";
// Menampilkan warna lingkaran
echo "Color of Circle: " . $circle -> getColor() . "<br>"; // Perbaikan: Menggunakan $circle
?>