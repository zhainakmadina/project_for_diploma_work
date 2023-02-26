<?php

class Action {
    public static function connect() {
        $connect = mysqli_connect("localhost", "root", "root", "diplom");
        if ($connect === false) {
            die("Ошибка: " . mysqli_connect_error());
        }
        return $connect;
    }

    public static function signup($name, $login, $email, $password, $conf_password) {
        $login_val = Action::check_free_login($login);
        $email_val = Action::check_free_email($email);
        $pass_val = Action::check_pass($password);
        $pass_conf = Action::check_pass_conf($password, $conf_password);
        if($login_val) {
            if($email_val) {
                if($pass_val) {
                    if($pass_conf) {
                        $connect = Action::connect();
                        $query = "INSERT INTO `users` (`id`, `name`, `login`, `email`, `password`) VALUES (NULL, '".$name."', '".$login."', '".$email."', '".md5($password)."')";
                        mysqli_query($connect, $query);
                        return "Success";
                    } else {
                        return "Passwords do not match";
                    }
                } else {
                    return "The number of characters in passwords must exceed 8 characters";
                }
            } else {
                return "User with this email already exists";
            }
        } else {
            return "User with this login already exists";
        }
    }

    public static function check_free_login($login) {
        $connect = Action::connect();
        $query = "SELECT id FROM users WHERE login = '".$login."'";
        $res = mysqli_query($connect, $query);
        if(mysqli_num_rows($res) > 0) {
            return false;
        }
        return true;
    }

    public static function check_free_email($email) {
        $connect = Action::connect();
        $query = "SELECT id FROM users WHERE email = '".$email."'";
        $res = mysqli_query($connect, $query);
        if(mysqli_num_rows($res) > 0) {
            return false;
        }
        return true;
    }

    public static function check_pass($password) {
        if(mb_strlen($password) < 8) {
            return false;
        }
        return true;
    }

    public static function check_pass_conf($password, $password_conf) {
        if($password !== $password_conf) {
            return false;
        }
        return true;
    }

    public static function auth($email, $password) {
        $connect = Action::connect();
        $query = "SELECT id, login FROM users WHERE email = '".$email."' AND password = '".md5($password)."'";
        $res = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($res);
        if(mysqli_num_rows($res) > 0) {
            session_start();
            $_SESSION["user"]["id"] = $row["id"];
            $_SESSION["user"]["login"] = $row["login"];
            return "Success";
        }
        return "Invalid email or password";
    }
}