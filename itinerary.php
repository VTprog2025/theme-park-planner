<?php
// TODO: Set user id (add session support later)
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
    <!-- TODO: Add site title and navigation -->
</header>

<main>
    <!-- TODO: Add itinerary list container -->
    <div id="itinerary-list"></div>
</main>

<footer>
    <!-- TODO: Add footer content -->
</footer>

<script>
    const USER_ID = <?php echo $user_id; ?>;
</script>
<script src="app.js"></script>
</body>
</html>
