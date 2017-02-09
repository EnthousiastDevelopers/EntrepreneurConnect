<?php include 'database.php'; ?>
<?php
//create Select Query
$query="Select * FROM shouts";
$shouts = mysqli_query($con, $query);
?>
<! DOCTYPE html >
<html>
<head>
<meta charset="utf8"/>
<title> Discussing Project</title>
<link rel="stylesheet" href="CSS/style.css" type="text/css"/>
</header>
<body>
<div id="container">
<header>
<h1> New Project</h1>
</header>
<div id="shouts">
<ul>
    <?php while ($row=mysqli_fetch_assoc(shouts)) : ?>
<li class="shout"><span><?php echo $row['time'] ?> = </span><strong><?php echo $row['name'] ?></strong>: <?php echo $row['name'] ?></li>

    <?php endwhile; ?>
</ul>
</div>
<div id="input">
<form method="post" action="preocess.php">
<input type="text" name="user" placeholder="Enter your name" />
<input type="text" name="message" placeholder="Enter a message" />
<br>
<input class="shout-btn" type="submit" name="submit" value="shout it out"/>
</form>
</div>
</body>
</html>