<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$First_name = $_GET['firstName'];
$Last_name = $_GET['lastName'];
$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "form_submission";
$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
// get profile
$profile = $conn->query("SELECT image_url FROM profiles WHERE first_name = '$First_name' AND last_name = '$Last_name'");
$profile_pic = "";
while ($row = $profile->fetch_assoc()) {
    $profile_pic = $row['image_url'];
}

// get email
$email = $conn->query("SELECT email FROM personal_information WHERE first_name = '$First_name' AND last_name = '$Last_name'");
$email_address = "";
while ($row = $email->fetch_assoc()) {
    $email_address = $row['email'];
}

// get high school
$hs = $conn->query("SELECT high_school FROM personal_information WHERE first_name = '$First_name' AND last_name = '$Last_name'");
$hs_name = "";
while ($row = $hs->fetch_assoc()) {
    $hs_name = $row['high_school'];
}

// get date of birth
$dob = $conn->query("SELECT date_of_birth FROM personal_information WHERE first_name = '$First_name' AND last_name = '$Last_name'");
$dob_year = "";
while ($row = $dob->fetch_assoc()) {
    $dob_year = $row['date_of_birth'];
}

// get interests
$interest_query = $conn->query("SELECT * FROM interests WHERE first_name = '$First_name' AND last_name = '$Last_name'");
$interests = array("ml", "web_dev", "react", "robotics", "flutter");
$interests_formal = array("Machine Learning", "Web Development", "React", "Robotics", "Flutter");
$interest_html_code = "";
while ($row = $interest_query->fetch_assoc()) {
    for ($i = 0; $i < 5; $i++) {
        if ($row[$interests[$i]] == "1") {  
            $interest_html_code = $interest_html_code . "<li class='Text'>$interests_formal[$i]</li>";
        }
    }
}

// get projects
$project_query = $conn->query("SELECT proj_name, proj_details FROM project_name WHERE first_name = '$First_name' AND last_name = '$Last_name'");
$number = 1;
$project_html_code = "";
while ($row = $project_query->fetch_assoc()) {
    $project_name = $row["proj_name"];
    $project_details = $row["proj_details"];
    $project_html_code = $project_html_code . "<h2 class='Subtitle'>Project $number: $project_name</h2>
<p class='Text'>$project_details</p>;";
    $number++;
}

$html_code = "
<html> 
    <head> 
        <title>User profile</title>
    </head>
    <h1 class='Intro'>User profile</h1> <br>
    <div class='Profile'>
        <img src='images/$profile_pic' class='profile_pic'>
        <h2 class='Subtitle'>Hello! I am $First_name $Last_name.</h2>
        <p class='Text'>I am a highschooler at $hs_name.</p>
        <p class='Text'>I was born on $dob_year.</p>
        <p class='Text'>You can reach me out at $email_address.</p>
        <h2 class='Subtitle'>I am interested in:</h2>
        <ul>
            $interest_html_code
        </ul>
        $project_html_code

        <br>
    </div>
    <br> <br>
    <body> 
        <style> 
            body, html {
                margin: 0px;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                line-height: 30px;
            }
            img.profile_pic {
                width: 200px;
                height: 200px;
                border-radius: 50%;
                margin-top: 50px;
                margin-left:35.6%;
                border: 3px solid #000;
            }
            h1.Intro {
                text-align: center;
                margin-top: 30px;
                font-size: 45px;
            }
            h2.Subtitle {
                text-align: center;
                margin-top: 30px;
                font-size: 30px;
            }

            p.Text {
                text-align: center;
                font-size: 20px;
                margin-right: 100px;
                margin-left: 100px;
            }

            li.Text {
                margin-left: 37%;
                font-size: 20px;
            }

            div.Profile {
                margin: auto;
                height: fit-content;
                width: 800px;
                background-color: rgb(193, 193, 193);
                border-radius: 20px;
                border: 3px solid #000;
                position: relative;
            }
        </style>
    </body>
</html>
";

echo $html_code;
?>