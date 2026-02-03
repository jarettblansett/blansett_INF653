<?php
/* Write a PHP script that takes an integerand determines if it is even or odd usingthe modulus % operator.
Expected Output
Input: 7
Output: 7 is an odd number. */
$number = 7;
if ($number % 2 == 0) {
    echo "$number is an even number.";
} else {
    echo "$number is an odd number.";
}
?>