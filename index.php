<?php
// TODO: Set user id (add session support later)
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
    <!-- TODO: Add site title and navigation -->
</header>

<main>
    <!-- TODO: Add filter controls (park, thrill level, max wait) -->

    <!-- TODO: Add ride results container -->
    <div id="ride-list"></div>
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
