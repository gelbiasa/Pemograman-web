<!-- Jobsheet 12 Praktikum 1. Basic OOP Langkah 6 -->
<?php
// Definisi kelas Animal
class Animal
{
    protected $name; // Properti untuk menyimpan nama hewan

    // Konstruktor untuk inisialisasi nama hewan
    public function __construct($name)
    {
        $this->name = $name; // Menetapkan nama hewan yang diberikan saat pembuatan objek
    }

    // Metode untuk memberi makan hewan
    public function eat()
    {
        echo $this->name . " is eating.<br>"; // Menampilkan pesan bahwa hewan sedang makan
    }

    // Metode untuk membuat hewan tertidur
    public function sleep()
    {
        echo $this->name . " is sleeping.<br>"; // Menampilkan pesan bahwa hewan sedang tidur
    }
}

// Definisi kelas Cat yang merupakan turunan dari kelas Animal
class Cat extends Animal
{
    // Metode khusus untuk membuat suara meong
    public function meow()
    {
        echo $this->name . " says meow!<br>"; // Menampilkan pesan bahwa kucing sedang mengeluarkan suara meong
    }
}

// Definisi kelas Dog yang merupakan turunan dari kelas Animal
class Dog extends Animal
{
    // Metode khusus untuk membuat suara gonggong
    public function bark()
    {
        echo $this->name . " says woof!<br>"; // Menampilkan pesan bahwa anjing sedang mengeluarkan suara woof
    }
}

// Membuat objek kucing dengan nama "Whiskers"
$cat = new Cat("Whiskers");

// Membuat objek anjing dengan nama "Buddy"
$dog = new Dog("Buddy");

// Memanggil metode eat() dari objek kucing
$cat->eat(); // Menampilkan pesan bahwa kucing sedang makan

// Memanggil metode sleep() dari objek anjing
$dog->sleep(); // Menampilkan pesan bahwa anjing sedang tidur

// Memanggil metode meow() dari objek kucing
$cat->meow(); // Menampilkan pesan bahwa kucing sedang mengeluarkan suara meong

// Memanggil metode bark() dari objek anjing
$dog->bark(); // Menampilkan pesan bahwa anjing sedang mengeluarkan suara woof
?>