<?php
// Set user id (add session support later)
$user_id = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Itinerary - Theme Park Planner</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>My Itinerary</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="itinerary.php">My Itinerary</a>
    </nav>
</header>

<main>
    <div id="itinerary-list"></div>
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
