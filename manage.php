<?php

$title = 'Car Rental Managment | ';
include('./config.php');
$required = false;
if (isset($_POST['contractNumber'])) {
    $contractNumber = $_POST['contractNumber'];
    echo "<script>console.log($contractNumber)</script>";
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $clientID = $_POST['clientID'];
    $registrationNumber = $_POST['registration-Number'];
    $duration = (strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24);
    $sql = "INSERT INTO contracts (ContractNumber, StartDate, EndDate, Duration, ClientID,RegistrationNumber) VALUES  (?,?,?,?,?,?)";
    $result = $conn->prepare($sql);
    $var = array($contractNumber, $startDate, $endDate, $duration, $clientID, $registrationNumber);
    if ($result->execute($var)) {
    echo "Contract added successfully!";
    echo "<script>console.log(true)</script>";
    } else {
    echo "Error: ";
    echo "<script>console.log(true)</script>";

    }
}
if (isset($_POST['ClientFullName'])) {
    $required = false;
    if(empty($_POST['ClientFullName']) || empty($_POST['CIN']) || empty($_POST['tel'] || empty($_POST['addresse']))) {
        // echo "All fields are required";
        $required = true;
        return ;
    }
    $FullName = $_POST['ClientFullName'];
    $CIN = $_POST['CIN'];
    $phone = $_POST['tel'];
    $Addresse = $_POST['adresse'];
    $sql = "INSERT INTO clients (ClientID, FullName, Addresse, Phone) VALUES (?,?,?,?)";
    $result = $conn->prepare($sql);
    $var = array($CIN, $FullName, $Addresse, $phone);
    // echo $var;
    if ($result->execute($var)) {
    echo "Client added successfully!";
    } else {
    echo "Error: ";
    echo "<script>console.log(false)</script>";
}}  
if(isset($_POST['registrationNumber'])){
    $registrationNumber = $_POST['registrationNumber'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $sql = "INSERT INTO cars (RegistrationNumber, Brand, Model, Year) VALUES (?,?,?,?)";
    $result = $conn->prepare($sql);
    $var = array($registrationNumber, $brand, $model, $year);
    // if ($result->execute($var)) {
    // echo "Car added successfully!";
    // echo "<script>console.log(true)</script>";
    // } else {
    // echo "Error: ";
    // echo "<script>console.log(true)</script>";

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="shortcut icon" href="srcs/imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?php echo $title . "Manage Contracts" ?></title>
</head>

<body>
    <header>
        <nav>
            <a href="index.html"><img src="srcs/imgs/logo.png" alt="Rent a Car"></a>

            <div class="menu">
                <!-- <ul>
                    <li><a href="index.php">Home</a></li>
                     <li><a href="about.php">About</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul> -->
                <div class="user">
                    <a href="index.php"><i class="fa-solid fa-user login"></i>Log out</a>
                    <!-- <a href="signup.php"><i class="fa-solid fa-user-plus sign-up"></i>Sign up</a> -->
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section>
            <div class="left-bar">
                <ul>
                    <li><button>Contracts</button></li>
                    <li><button>Client</button></li>
                    <li><button>Cars</button></li>
                </ul>
            </div>
            <div class="right-bar">
                <div>
                    <input type="text" id="search" placeholder="Search..">
                    <input type="button" value="Add a Contract" id="addContractBtn">
                </div>
                <div class="Info">

                    <?php
                    
                    $contracts = $conn->query("SELECT * FROM contracts");

                    if ($contracts->num_rows > 0) {
                        while ($row = $contracts->fetch_assoc()) {

                            echo "<div class='contractInfo'>" .
                                "<h3>Contract: <span>'{$row["ContractNumber"]}'</span></h3>";
                            echo "<p>Duration: <span>'{$row["Duration"]}' Day(s) </span></p>";
                            echo "<p>Client: <span>'{$conn->query("SELECT FullName FROM clients where ClientID = {$row['ClientID']}")->fetch_object()->FullName}'</span> </p>";
                            echo "<p>Car: <span>'{$conn->query("SELECT Model FROM cars where RegistrationNumber = '{$row['RegistrationNumber']}'")->fetch_object()->Model}'</span></p>";
                            echo "<p>Start Date: <span>'{$row['StartDate']}'</span> </p>";
                            echo "<p>End Date: <span>'{$row['EndDate']}'</span></p>";
                            $price = $row['Duration'] * 20;
                            echo "<p>Total Price: <span>'$ {$price} '</span></p>";
                            echo "<div>";
                            echo "<button><i class='fa-solid fa-trash'></i></button>" .
                                "<button><i class='fa-regular fa-pen-to-square'></i></button>" .
                                "</div> </div>";
                        }
                    } else {
                        echo "No Contracts found.";
                    }
                    ?>
                </div>
                <div class="addContract">
                    <form method="post" id="addContract" action="manage.php">
                        <h2>Add a New Contract</h2>
                        <input type="text" id="contractNumber" name="contractNumber" placeholder="Contract Number">
                        <label for="startDate">Start Date:</label>
                        <input type="date" id="startDate" name="startDate">
                        <label for="endDate">End Date:</label>
                        <input type="date" id="endDate" name="endDate">
                        <select id="clientID" name="clientID">
                            <?php
                            $clients = $conn->query("SELECT * FROM clients");
                            while ($row = $clients->fetch_assoc()) {
                                echo "<option value='{$row["ClientID"]}'>{$row["FullName"]}</option>";
                            }
                            echo "<option value='addClient' style='background-color:darkorange;color:white; text-align:center;font-weight:bold;''>Add a New Client</option>";


                            ?>
                        </select>
                        <select id="registration-Number" name="registration-Number">
                            <?php
                            $cars = $conn->query("SELECT * FROM cars");

                            while ($row = $cars->fetch_assoc()) {
                                echo "<option value='{$row["RegistrationNumber"]}'>{$row["Model"]}</option>";
                            }
                            echo "<option value='addCar' style='background-color:darkorange;color:white;font-weight:bold;text-align:center;'>Add a New Car</option>";
                            ?>
                        </select>

                        <input type="submit" value="Add Contract">
                    </form>

                </div>
                <div class="addClient" id="addClient">
                <form method="post" id="add-client">
                    <h2>Add a New Client</h2>
                    <input type="text" id="CIN" name="CIN" placeholder="CIN">
                    <input type="text" id="FullName" name="ClientFullName" placeholder="Full Name">
                    <input type="tel" id="tel" name="tel" placeholder="Phone Number">
                    <input type="text" id="address" name="adresse" placeholder="Adresse">
                    <input type="submit" value="Add Client">
                    <?php if($required){
                        echo "<p class='error'>Please fill all required fields</p>";
                    } ?>
                </form>
            </div>
            <div class="addCar">
                <form method="post" id="addCar">
                    <h2>Add a New Car</h2>
                    <input type="text" id="registrationNumber" name="registrationNumber" placeholder="Registration Number">
                    <input type="text" id="brand" name="brand" placeholder="Brand">
                    <input type="text" id="model" name="model" placeholder="Model">
                    <input type="text" id="year" name="year" placeholder="Year">
                    <input type="submit" value="Add Car">

                </form>
            </div>
                        </div>


            <script>
                // Add your JavaScript code here
                // Example:
                // document.querySelector('.close-btn').addEventListener('click', function() {
                //     document.querySelector('.error').classList.add('hidden');
                // });
                // document.querySelector('.show-error-btn').addEventListener('click', function() {
                //     document.querySelector('.error').classList.remove('hidden');
                // });
                // document.querySelector('.show-details-btn').addEventListener('click', function() {
                //     document.querySelector('.details-container').classList.remove('hidden');
                // });
                // document.querySelector('.close-details-btn').addEventListener('click', function() {
                //     document.querySelector('.details-container').classList.add('hidden');
                // });
                // document.querySelector('.error-msg').addEventListener('click', function() {
                //     document.querySelector('.error-details').classList.remove('hidden');
                // });
                // document.querySelector('.close-error-btn').addEventListener('click', function() {
                //     document.querySelector('.error-details').classList.add('hidden');
                // });
                // document.querySelector('.error-msg').addEventListener('mouseover', function() {
                //     document.querySelector('.error-details').classList.remove('hidden');
                // });
                // document.querySelector('.error-msg').addEventListener('mouseout', function() {
                //     document.querySelector('.error-details').classList.add('hidden');
                // });
                // document.querySelector('.show-error-btn').addEventListener('mouseover', function() {
                //     document.querySelector('.error').classList.remove('hidden');
                // });
                // document.querySelector('.show-error-btn').addEventListener('mouseout', function() {
                //     document.querySelector('.error').classList.add('hidden');
                // });
            </script>


            </div>


            </div>
        </section>
    </main>
    <footer>
        <div>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <!-- <li><a href="#">Services</a></li> -->
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
        <p>&copy; Rent a Car Managment. All rights reserved.</p>
    </footer>

    <script src="main.js"></script>
</body>

</html>