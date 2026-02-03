<?php
/* Write a PHP script that takes a student’s
marks and assigns a grade using the
following conditions:
•90+ → A
•80-89 → B
•70-79 → C
•60-69 → D
•Below 60 → F
Expected Output
Input: 85
Output: You got a B! */

$marks = 85;
 if ($marks >= 90) {
    echo "You got an A!";}
 elseif ($marks >= 80 && $marks < 90) {
    echo "You got a B!";}
 elseif ($marks >= 70 && $marks < 80) {
    echo "You got a C!";}
 elseif ($marks >= 60 && $marks < 70) {
    echo "You got a D!";}
 else {
    echo "You got an F!";}
?>