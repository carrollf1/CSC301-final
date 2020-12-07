<?php
    include('config.php');
    include('functions.php');

    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $personality = $_POST['personality'];
    $catchphrase = $_POST['catchphrase'];
    
    $searchTerm = get('search-term');
    $villagers = searchVillagers($searchTerm, $database);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Animal Crossing</title>
    <link rel = "stylesheet" href="css/style.css">
</head>
<body>
    <div class="page">
        <h1>Current Villager</h1>
        <form>
            <input type="text" name="search-term" placeholder="Search current villagers" />
            <input type="submit" class="button"/>
            <p><strong>Name: </strong><?php echo $name ?></p>
            <p><strong>Gender: </strong><?php echo $gender ?></p>
            <p><strong>Personality: </strong><?php echo $personality ?></p>
            <p><strong>Catchphrase: </strong><?php echo $catchphrase ?></p>
            <p>
                <a href="index.php" class="button">Add another villager</a>
                <a href="index.php?action=edit" class = "button">Edit current villager</a>
            </p>
        </form>-
        <?php foreach($villagers as $villager) : ?>
            <p>
                <strong><?php echo $villager['name'] ?></strong><br />
                <?php echo $villager['gender'] ?><br />
                <?php echo $villager['personality'] ?><br />
                <?php echo $villager['catchphrase'] ?><br />
            </p>
        <?php endforeach; ?>
    </div>
</body>
</html>




