<?php
/*Create a PHP script that takes two numbers and performs 
addition, subtraction, multiplication, division, and modulus operations.
Expected Output 
Number 1: 10
Number 2: 5
Addition: 15
Subtraction: 5
Multiplication: 50
Division: 2
Modulus: 0 */

$number1 = 10;
$number2 = 5;
$Addition = $number1 + $number2;
$Subtraction = $number1 - $number2;
$Multiplication = $number1 * $number2;
$Division = $number1 / $number2;
$Modulus = $number1 % $number2;

echo "Number 1: " . $number1;
echo "<br>Number 2: " . $number2;
echo "<br>Addition: " . $Addition;
echo "<br>Subtraction: " . $Subtraction;
echo "<br>Multiplication: " . $Multiplication;
echo "<br>Division: " . $Division;
echo "<br>Modulus: " . $Modulus;
?>