<?php 
    // connect to database
    $dbServerName = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "form_submission";
    $conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

    $interest = $_POST["interest"];
    $name = $_POST["name"];
    $sql_get_student = "SELECT first_name, last_name FROM interests WHERE $interest=1;";
    $result = mysqli_query($conn, $sql_get_student);
    $resultCheck = mysqli_num_rows($result);
    $margin_left = 1;
    $echo_statement = "";
    if ($name != "") {
        $echo_statement .= "<p class='BlockIntro' id='ml'>Results:</p>";
    }
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $FirstName = $row["first_name"];
            $LastName = $row["last_name"];
            
            if ($name != "") {
                if (sizeof(explode(" ", $name)) != 2 || $FirstName != explode(" ", $name)[0] || $LastName != explode(" ", $name)[1]) {
                    continue;
                }
            }

            $sql_get_profile_pic = "SELECT image_url FROM profiles WHERE first_name='$FirstName' AND last_name='$LastName';";
            $profile_pic_result = mysqli_query($conn, $sql_get_profile_pic);
            $profile_pic = "";
            while ($profile = mysqli_fetch_assoc($profile_pic_result)) {
                $profile_pic = $profile["image_url"];
            }
            $profile_pic_result->data_seek(0);
            $interest_result = mysqli_query($conn, "SELECT * FROM interests WHERE first_name = '$FirstName' AND last_name='$LastName';");
            $project_result =  mysqli_query($conn, "SELECT proj_name FROM project_name WHERE first_name = '$FirstName' AND last_name='$LastName';");
            
            $project_show = "";
            while ($project_row = mysqli_fetch_assoc($project_result)) {
                $project_show = $project_show . $project_row["proj_name"] . ", ";
            }
            $project_result->data_seek(0);

            $interest_show = "";
            $interests = array("ml", "web_dev", "react", "robotics", "flutter");
            $interests_formal = array("Machine Learning", "Web Development", "React", "Robotics", "Flutter");
            $interest_row = mysqli_fetch_assoc($interest_result);
            for ($i = 0; $i < 5; $i++) {
                if ($interest_row[$interests[$i]] == "1") {
                    $interest_show = $interest_show . $interests_formal[$i] . ", ";
                }    
            }
            $interest_result->data_seek(0);
            $echo_statement = $echo_statement . "
            <div class='PersonBlock' style='margin-left: $margin_left" . "%' onclick='showProfile(this)'>
                <img class='Profile' src='images/$profile_pic'>
                <p class='Name'>$FirstName $LastName<p>
                <p class='Info'> <span style='font-weight: bold;'>Skills: </span> <br> $interest_show <p>
                <p class='Info'> <span style='font-weight: bold;'>Projects: </span> <br> $project_show </p>
            </div>
            ";
            $margin_left+=30;
        }
    }
    echo $echo_statement;  
?>