<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Import Font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;700&display=swap" rel="stylesheet">

    <!-- Import CSS -->
    <link rel="stylesheet" href="/assets/css/general.css">
    <link rel="stylesheet" href="/assets/css/reg.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Import JS -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="/assets/js/auth.js"></script>

    <title>Diplom</title>
</head>
<body>
    <div class="container">
        <div class="form">
            <h2>Registration</h2>
            <form id="signup">
                <div class="input">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="name" placeholder="Enter name" required>
                </div>
                <div class="input">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <input type="text" name="login" placeholder="Enter login" required>
                </div>
                <div class="input">
                    <i class="fa-sharp fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="Enter email" required>
                </div>
                <div class="input">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Enter password" required>
                </div>
                <div class="input">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="conf_password" placeholder="Confirm password" required>
                </div>
                <button>Sign Up</button>
                <p id="err"></p>
            </form>

            <div class="signup">Do you have an account? <a href="/signin">Signin now</a></div>
        </div>
        <div class="text">
            <h3>Every new friend is a new adventure.</h3>
            <p>let's get connected</p>
        </div>

        <div class="bg">
            <img src="/assets/img/reg-bg.jpg" alt="">
        </div>
    </div>
</body>
</html>