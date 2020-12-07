<?php 

include('config.php');
include('functions.php');

$action = get('action');
$name = get('name');
$villager = null;

if(!empty($name)) {
    $sql = file_get_contents('sql/getVillager.sql');
    $params = array(
        'name' => $name
    );
    $statement = $database->prepare($sql);
    $statement->execute($params);
    $villagers = $statement->fetchAll(PDO::FETCH_ASSOC);

    $villager = $villagers[0];
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $personality = $_POST['personality'];
    $catchphrase = $_POST['catchphrase'];

    if($action == 'add') {
        $sql = file_get_contents('sql/insertVillager.sql');
        $params = array(
            'name' => $name,
            'gender' => $gender,
            'personality' => $personality,
            'catchphrase' => $catchphrase
        );

        $statement = $database->prepare($sql);
        $statment->execute($params);
    }

    elseif($action == 'edit') {
        $sql = file_get_contents('sql/updateVillager.sql');
        $params = array(
            'name' => $name
        );

        $statement = $database->prepare($sql);
        $statment->execute($params);

        $sql = file_get_contents('sql/insertVillager.sql');
        $params = array(
            'name' => $name,
            'gender' => $gender,
            'personality' => $personality,
            'catchphrase' => $catchphrase
        );

        $statement = $database->prepare($sql);
        $statment->execute($params);
    }

    header('location: form.php');
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Animal Crossing</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="page">
            <header>
                <img id="center" src="images/logo.png" alt="Animal Crossing Logo">
            </header>
            <form action="form.php" method="POST">
                <fieldset><legend>Create your own AC village by adding your favorite villagers:</legend>
                    <p><label>Name:</label>
                    <?php if($action == 'edit') : ?>
                        <input readonly type = "text" name="name" value ="<?php echo $villager['name'] ?>">
                    <?php else : ?>
                        <input type = "text" name="name">
                    <?php endif; ?>
                    </p>
                    <p><label for="gender">Gender: </label> 
                    <?php if($action == 'edit') : ?>
                        <input type = "radio" class="radiobtn" name="gender" value="M">Male 
                        <input type="radio" class="radiobtn" name="gender" value="F">Female
                    <?php else : ?>    
                        <input type = "radio" class="radiobtn" name="gender" value="M">Male 
                        <input type="radio" class="radiobtn" name="gender" value="F">Female
                    <?php endif; ?>
                    </p>
                    <p><label>Personality:</label>
                    <?php if($action == 'edit') : ?>
                        <select name="personality">
                            <option value="lazy">Lazy</option>
                            <option value="jock">Jock</option>
                            <option value="cranky">Cranky</option>
                            <option value="smug">Smug</option>
                            <option value="sweet">Sweet</option>
                            <option value="peppy">Peppy</option>
                            <option value="snooty">Snooty</option>
                            <option value="bigSis">Big Sis</option>
                        </select>
                    <?php else : ?>
                        <select name="personality">
                            <option value="lazy">Lazy</option>
                            <option value="jock">Jock</option>
                            <option value="cranky">Cranky</option>
                            <option value="smug">Smug</option>
                            <option value="sweet">Sweet</option>
                            <option value="peppy">Peppy</option>
                            <option value="snooty">Snooty</option>
                            <option value="bigSis">Big Sis</option>
                        </select>
                    <?php endif; ?>
                    </p>
                    <p><label>Catchphrase:</label>
                    <?php if($action == 'edit') : ?>
                        <input type = "text" name="catchphrase" value="<?php echo $villager['catchphrase'] ?>">
                    <?php else : ?>
                        <input type = "text" name="catchphrase">
                    <?php endif; ?>
                    </p>
                </fieldset>
                <input type="submit" class = "button" value="Add"/>
            </form><br />
        </div>
    </body>
    <footer>
        <p>Copyright &copy; 2020</p>
    </footer>
</hmtl>