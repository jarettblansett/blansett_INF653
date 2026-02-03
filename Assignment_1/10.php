<?php
/* Write a PHP script to check if a given year
is a leap year or not.
Expected Output
Input: 2024
Output: 2024 is a leap year. */

$year = 2024;
if (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) {
    echo "$year is a leap year.";
} else {
    echo "$year is not a leap year.";
}
?>