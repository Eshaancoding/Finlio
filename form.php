<?php
    if ($_POST) {
        // connect to database
        $dbServerName = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "form_submission";
        $conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

        // get form results
        $FirstName = $_POST["fname"];
        $LastName = $_POST["lname"];
        $HighSchool = $_POST["highschool"];
        $birth = $_POST["birth"];
        $email = $_POST["email"];
        $ML_interest = "FALSE";
        if (array_key_exists('ML_interest', $_POST)) {
            $ML_interest = "TRUE";
        }
        $Web_interest = "FALSE";
        if (array_key_exists('website_interest', $_POST)) {
            $Web_interest = "TRUE";
        }
        $React_interest = "FALSE";
        if (array_key_exists('React_interest', $_POST)) {
            $React_interest = "TRUE";
        }
        $Robot_interest = "FALSE";
        if (array_key_exists('Robotics_interest', $_POST)) {
            $Robot_interest = "TRUE";
        }
        $Flutter_interest = "FALSE";
        if (array_key_exists("Flutter_interest", $_POST)) {
            $Flutter_interest = "TRUE";
        }
        $projNames = array();
        $projDetails = array();
        for ($x = 1; $x <= 10; $x++) {
            if (array_key_exists("projName" . $x, $_POST)) {
                $projNames[] = $_POST["projName" . $x];
                $projDetails[] = $_POST["projDetails" . $x];
            }
        }
        # image (thanks to Coding with Elias for the code, literally just copied and pasted :D )
        $img_name = $_FILES['profile']['name'];
        $img_size = $_FILES['profile']['size'];
        $tmp_name = $_FILES['profile']['tmp_name'];
        $error = $_FILES['profile']['error'];

        if ($error === 0) {
            if ($img_size > 125000) {
                header("Location: main.html");
            }else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png"); 

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                    $img_upload_path = 'images/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    // Insert into Database
                    $sql = "INSERT INTO profiles (first_name, last_name, image_url) VALUES('$FirstName', '$LastName', '$new_img_name')";
                    mysqli_query($conn, $sql);
                }else {
                    header("Location: main.html");
                }
            }
        } else {
            header("Location: main.html");
        }

        # execute queries
        $personal_info_query = "INSERT INTO personal_information (first_name, last_name, high_school, email, date_of_birth) VALUES
        ('" . $FirstName . "', '" . $LastName . "', '" . $HighSchool . "', '" . $email . "', '" . $birth . "');";
        mysqli_query($conn, $personal_info_query);
        $interest_query = "INSERT INTO interests (first_name, last_name, ml, web_dev, react, robotics, flutter) VALUES
        ('" . $FirstName . "','" . $LastName . "'," . $ML_interest . "," . $Web_interest . "," . $React_interest . "," . $Robot_interest . ", " . $Flutter_interest . ")";
        mysqli_query($conn, $interest_query);
        for ($x = 0; $x < count($projNames); $x++) {
            $proj_query = "INSERT INTO project_name (first_name, last_name, proj_name, proj_details) VALUES ('" . $FirstName . "', '" . $LastName . "', '" . $projNames[$x] . "', '" . $projDetails[$x] . "');";
            mysqli_query($conn, $proj_query); 
        }
        
        header("Location: main.html");
    }
?> 