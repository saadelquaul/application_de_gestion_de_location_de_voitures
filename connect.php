<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $conn = mysqli_connect('localhost','root','saadox+12345','location_de_voitures_db') or die("Connection failed: ".mysqli_connect_error());
    }
?>