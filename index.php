<?php
// Set user id (add session support later)
$user_id = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme Park Planner</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Theme Park Planner, Disney Edition!</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="itinerary.php">My Itinerary</a>
    </nav>
</header>

<main>
    <div id="filters">
        <label for="park-select">Park:</label>
        <select id="park-select">
            <option value="">All Parks</option>
            <option value="Magic Kingdom">Magic Kingdom</option>
            <option value="Epcot">Epcot</option>
            <option value="Hollywood Studios">Hollywood Studios</option>
            <option value="Animal Kingdom">Animal Kingdom</option>
        </select>

        <label for="thrill-level-select">Thrill Level:</label>
        <select id="thrill-level-select">
            <option value="">All Levels</option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
        </select>

        <label for="max-wait-time">Max Wait Time (minutes):</label>
        <input type="number" id="max-wait-time" min="0">

        <button id="filter-button">Apply Filters</button>
    </div>

    <div id="spinner" class="spinner hidden"></div>
    <div id="ride-list"></div>
</main>

<footer>
    <p>&copy; 2026 Theme Park Planner. All rights reserved.</p>
</footer>

<div id="toast" class="toast hidden"></div>

<script>
    const USER_ID = <?php echo $user_id; ?>;
</script>
<script src="app.js"></script>
</body>
</html>
