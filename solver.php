<?php
// solver.php - Handles form submission and computes maximum subarray sum based on selected algorithm

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input array from the form
    $input = $_POST['array'];
    $array = explode(",", $input);
    $array = array_map('intval', $array);  // Convert strings to integers

    // Get the selected algorithm
    $algorithm = $_POST['algorithm'];

    // Choose the algorithm and compute the maximum subarray sum
    switch ($algorithm) {
        case 'kadane':
            $max_sum = kadaneAlgorithm($array);
            break;
        case 'brute_force':
            $max_sum = bruteForceMaxSubarray($array);
            break;
        case 'divide_conquer':
            $max_sum = divideAndConquerMaxSubarray($array, 0, count($array) - 1);
            break;
        default:
            echo "Invalid algorithm selected!";
            exit();
    }

    // Redirect back to the main page with the result
    header("Location: ../index.php?result=" . $max_sum);
    exit();
}

// Kadane's Algorithm (O(n))
function kadaneAlgorithm($array) {
    $current_max = $global_max = $array[0];
    for ($i = 1; $i < count($array); $i++) {
        $current_max = max($array[$i], $current_max + $array[$i]);
        $global_max = max($global_max, $current_max);
    }
    return $global_max;
}

// Brute Force Algorithm (O(n²))
function bruteForceMaxSubarray($array) {
    $n = count($array);
    $max_sum = PHP_INT_MIN;
    for ($i = 0; $i < $n; $i++) {
        $current_sum = 0;
        for ($j = $i; $j < $n; $j++) {
            $current_sum += $array[$j];
            $max_sum = max($max_sum, $current_sum);
        }
    }
    return $max_sum;
}

// Divide and Conquer Algorithm (O(n log n))
function divideAndConquerMaxSubarray($array, $low, $high) {
    if ($low == $high) {
        return $array[$low];  // Base case: only one element
    }

    $mid = floor(($low + $high) / 2);

    // Find the maximum subarray sum in the left half, right half, and crossing the mid
    $left_max = divideAndConquerMaxSubarray($array, $low, $mid);
    $right_max = divideAndConquerMaxSubarray($array, $mid + 1, $high);
    $cross_max = maxCrossingSubarray($array, $low, $mid, $high);

    return max($left_max, $right_max, $cross_max);
}

// Helper function for Divide and Conquer (find the max sum crossing the middle)
function maxCrossingSubarray($array, $low, $mid, $high) {
    $left_sum = PHP_INT_MIN;
    $sum = 0;
    for ($i = $mid; $i >= $low; $i--) {
        $sum += $array[$i];
        if ($sum > $left_sum) {
            $left_sum = $sum;
        }
    }

    $right_sum = PHP_INT_MIN;
    $sum = 0;
    for ($i = $mid + 1; $i <= $high; $i++) {
        $sum += $array[$i];
        if ($sum > $right_sum) {
            $right_sum = $sum;
        }
    }

    return $left_sum + $right_sum;
}
?>
