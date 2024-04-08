<!-- Jobsheet 12 Praktikum 1. Basic OOP Langkah 6 Soal no 1.3 -->
<?php
// Mendefinisikan antarmuka Shape
interface Shape {
    public function calculateArea();
}

// Mendefinisikan kelas Circle yang mengimplementasikan antarmuka Shape
class Circle implements Shape {
    private $radius;

    // Konstruktor untuk menginisialisasi radius lingkaran
    public function __construct($radius) {
        $this->radius = $radius;
    }

    // Metode untuk menghitung luas lingkaran
    public function calculateArea() {
        return pi() * pow($this->radius, 2);
    }
}

// Mendefinisikan kelas Rectangle yang mengimplementasikan antarmuka Shape
class Rectangle implements Shape {
    private $width;
    private $height;

    // Konstruktor untuk menginisialisasi lebar dan tinggi persegi panjang
    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }

    // Metode untuk menghitung luas persegi panjang
    public function calculateArea() {
        return $this->width * $this->height;
    }
}

// Fungsi untuk mencetak luas area bentuk (polimorfisme)
function printArea(Shape $shape) {
    echo "Area: " . $shape->calculateArea() . "<br>";
}

// Membuat objek Circle dengan jari-jari 5
$circle = new Circle(5);
// Membuat objek Rectangle dengan lebar 4 dan tinggi 6
$rectangle = new Rectangle(4, 6);

// Memanggil fungsi printArea dengan objek Circle
printArea($circle);
// Memanggil fungsi printArea dengan objek Rectangle
printArea($rectangle);
?>