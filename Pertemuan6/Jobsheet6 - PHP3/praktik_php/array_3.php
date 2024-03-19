<!DOCTYPE HTML>
<!-- Praktikum Bagian 3. Multidimensional Array Langkah 2 -->
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css" /> <!-- Menghubungkan file CSS untuk styling -->
</head>

<body>
    <h2> Multidimensional Array </h2>
    <table>
        <tr>
            <th>Judul Film</th>
            <th>Tahun</th>
            <th>Rating</th>
        </tr>
        <?php
        // Array multidimensional yang berisi detail film
        $movie = array(
            array("Avengers: Infinity War", 2018, 8.7),
            array("The Avengers", 2012, 8.1),
            array("Guardians of the Galaxy", 2014, 8.1),
            array("Iron Man", 2008, 7.9)
        );

        // Menampilkan setiap baris film dengan mengakses indeks array secara langsung
        echo "<tr>";
        echo "<td>" . $movie[0][0] . "</td>"; // Judul film baris pertama
        echo "<td>" . $movie[0][1] . "</td>"; // Tahun rilis baris pertama
        echo "<td>" . $movie[0][2] . "</td>"; // Rating baris pertama
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $movie[1][0] . "</td>"; // Judul film baris kedua
        echo "<td>" . $movie[1][1] . "</td>"; // Tahun rilis baris kedua
        echo "<td>" . $movie[1][2] . "</td>"; // Rating baris kedua
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $movie[2][0] . "</td>"; // Judul film baris ketiga
        echo "<td>" . $movie[2][1] . "</td>"; // Tahun rilis baris ketiga
        echo "<td>" . $movie[2][2] . "</td>"; // Rating baris ketiga
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $movie[3][0] . "</td>"; // Judul film baris keempat
        echo "<td>" . $movie[3][1] . "</td>"; // Tahun rilis baris keempat
        echo "<td>" . $movie[3][2] . "</td>"; // Rating baris keempat
        echo "</tr>";
        ?>

    </table>
</body>

</html>
