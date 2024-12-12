<?php

$title = 'Car Rental Managment | ';
include('./config.php');
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
                        <input type="button" value="Add a Contract">
                    </div>
                    <div class="Info hidden">
                        
                        <?php
                        $contracts = $conn->query("SELECT * FROM contracts");

                        if ($contracts->num_rows > 0) {
                            while ($row = $contracts->fetch_assoc()) {

                            echo "<div class='contractInfo'>".
                            "<h3>Contract: <span>'{$row["ContractNumber"]}'</span></h3>";
                            echo "<p>Duration: <span>'{$row["Duration"]}' Day(s) </span></p>";
                            echo "<p>Client: <span>'{$conn->query("SELECT firstName FROM clients where ClientID = {$row['ClientID']}")->fetch_object()->firstName}'</span> </p>";
                            echo "<p>Car: <span>'{$conn->query("SELECT Model FROM cars where RegistrationNumber = '{$row['RegistrationNumber']}'")->fetch_object()->Model}'</span></p>";
                            echo "<p>Start Date: <span>'{$row['StartDate']}'</span> </p>";
                            echo "<p>End Date: <span>'{$row['EndDate']}'</span></p>";
                            echo "<p>Total Price: <span>'$ {$row['Duration']} '</span></p>";
                            echo "<div>";
                            echo "<button><i class='fa-solid fa-trash'></i></button>".
                                "<button><i class='fa-regular fa-pen-to-square'></i></button>".
                            "</div> </div>";
                            }
                           } else {
                            echo "No Contracts found.";
                           }
                            ?>
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