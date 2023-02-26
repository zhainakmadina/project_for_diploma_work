<?php

// $path = $_SERVER['DOCUMENT_ROOT'].'/modules/mutation/xsstrike.py';
// $path_cmd = str_replace('/','\\', $path);
// $python_output = shell_exec("python {$path_cmd} -u \"https://www.cyberpunk.rs\"");
// echo $python_output;



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <div class="dashboard-wp">
        <h1>Welcome to OSAT! The Open Source Audit Toolkit</h1>
        <p>We are working hard on creating a free & Open source solution for all of your SEO issues. We will keep on building and improving it. From SEO to NLP and Security. We will add everything.</p>
        <div class="dashboard-buttons">
            <a href="#"><i class="fa-solid fa-house"></i> Documentation</a>
            <a href="#"><i class="fa-brands fa-github"></i> Github</a>
        </div>
    </div>

    <h1 class="dashboard_url_title">Enter your url:</h1>
    <form action="#" class="form_url">
        <input type="text" placeholder="https://www.google.com">
        <button><i class="fa-solid fa-chart-simple"></i> Audit site</button>
    </form>
</body>
</html>