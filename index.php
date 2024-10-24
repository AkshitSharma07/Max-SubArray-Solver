<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maximum Subarray Problem Solver</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Maximum Subarray Problem Solver</h1>
        <form method="POST" action="php/solver.php">
            <label for="array">Enter the array (comma-separated):</label>
            <input type="text" id="array" name="array" placeholder="e.g., -2, 1, -3, 4, -1, 2, 1, -5, 4" required>

            <label for="algorithm">Choose the algorithm:</label>
            <select name="algorithm" id="algorithm" required>
                <option value="kadane">Kadane's Algorithm (O(n))</option>
                <option value="brute_force">Brute Force (O(n²))</option>
                <option value="divide_conquer">Divide and Conquer (O(n log n))</option>
            </select>

            <button type="submit">Find Maximum Subarray Sum</button>
        </form>

        <!-- Result Section (this will display the result after form subsset($_GET['result'])): ?>
            <div class="result">
                <h2>Maximum Subarray Sum: <?php echo htmlspecialchars($_GET['result']); ?></h2>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
