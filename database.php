<?php
include('connect.php');

// $var="Create Table admin (
//     adminID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     name varchar(10),
//     password varchar(20),
// )";

// $var="Create Table customer (
//     CustomerID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     Cname varchar(10),
//     Cemail varchar(20),
//     Cphone varchar(20),
//     Cpassword varchar(20),
//     Caddress varchar(255)
// )";

// $var="Create Table staff (
//     StaffID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     Sname varchar(10),
//     Sdob varchar(30),
//     Sposition varchar(20),
//     Sphone varchar(20),
//     Semail varchar(20),
//     Saddress varchar(255),
//     Ssalary int,
//     FDOE date,
//     Sattendance int
// )";

// $var="CREATE TABLE category (
//     cateID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     cateType varchar(30)
// )";

// $var="CREATE TABLE package (
//     packageID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     package_name varchar(20),
//     package_price int,
//     package_image varchar(255),
//     Description varchar(255),
//     cateID int,
//     Foreign key (cateID) REFERENCES category (cateID)
// )";

// $var="Create Table UnDate (
//     DateID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     UnDate varchar(10)

// )";

// $var="Create Table Feedbacks (
//     FeedbackID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     Post_date date,
//     Post_time time,
//     Comments varchar(255),
//     CustomerID int,
//     packageNamee varchar (50)

// )";

// $var="Create Table Orders (
//     OrderID varchar(20) NOT NULL PRIMARY KEY,
//     OrderDate timestamp,
//     OrderType varchar(30),
//     CustomerID int,
//     DeliveryLocation varchar(255),
//     PaymentType varchar(50),
//     CartNumber int,
//     ShootingLocation varchar(200),
//     OrderStatus varchar(20)
// )";

$var="Create Table Orderdetails (
    OrderID varchar(20) NOT NULL,
    PackageID int NOT NULL,
    image1 varchar(255),
    image2 varchar(255),
    image3 varchar(255),
    image4 varchar(255),
    image5 varchar(255),
    image6 varchar(255),
    image7 varchar(255),
    image8 varchar(255),
    image9 varchar(255),
    image10 varchar(255),
    file varchar(255),
    Primary Key (OrderID,PackageID)
)";



$query = mysqli_query($connect,$var);
$message = "You created a new table";
if ($query)
    {
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

?>