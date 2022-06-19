<?php

require_once "../config.php";
session_start();

//register users
function registerUser($fullnames, $email, $password, $gender, $country){
    //create a connection variable using the db function in config.php
    $conn = db(zuriphp);
   //check if user with this email already exist in the database
   $sql = "SELECT * FROM Students WHERE email ='$email'";
   $result = mysqli_query($db,$sql);
   $email = mysqli_fetch_assoc($result);
   if($email){
   // if user exists
    if($email['email']===$email){
      echo "Email already exists";;
   }
  }
  else {
    $query = "INSERT INTO Students(fullnames, email, password, gender, country) VALUES($fullnames, $email, $password, $gender, $country)";
    mysqli_query($db, $query)
  }


//login users
function loginUser($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db(zuriphp);

    echo "<h1 style='color: red'> LOG ME IN (IMPLEMENT ME) </h1>";
    //open connection to the database and check if username exist in the database
    //if it does, check if the password is the same with what is given
    //if true then set user session for the user and redirect to the dasbboard
    $query = "SELECT * FROM Students WHERE email ='$email' AND password ='$password'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1){
      $_SESSION['email'] = $email;
      echo "You're logged in";
      header("location: index.php");
    }
    else {
      echo "Invalid details";
      header("location: login.html");
    }
}


function resetPassword($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db(zuriphp);
    echo "<h1 style='color: red'>RESET YOUR PASSWORD (IMPLEMENT ME)</h1>";
    //open connection to the database and check if username exist in the database
    //if it does, replace the password with $password given
     $sql = "SELECT email,password FROM Students WHERE email ='$email'";
       $result = mysqli_query($db, $sql)
       if (mysqli_num_rows($result) == 1){
         $query = "UPDATE Students SET password= '$password' WHERE email = '$email'";
         $result = mysqli_query($db, $query);
         header('location: login.html')
       }
}

function getusers(){
    $conn = db(zuriphp);
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo"<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1>
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<tr style='height: 30px'>".
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] .
                "</td> <td style='width: 150px'>" . $data['country'] .
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
                "</tr>";
        }
        echo "</table></table></center></body></html>";
    }
    //return users from the database
    //loop through the users and display them on a table
    $result ->free();
}

 function deleteaccount($id){
     $conn = db(zuriphp);
     //delete user with the given id from the database
     $query = " SELECT FROM Students WHERE id ='$id'";
     $result = mysqli_query($db,$query);
 }
