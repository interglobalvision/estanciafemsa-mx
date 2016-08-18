<?php

// Custom functions (like special queries, etc)

// adds leading 0 for numbers less than 2 digits
function add_leading_zero($number) {
  return sprintf("%02d", $number);
}