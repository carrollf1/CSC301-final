<?php
function searchVillagers($term, $database) {
    $sql = file_get_contents('sql/searchVillagers.sql');
    $statement = $database->prepare($sql);
    $statement->execute([$term]);
    $villagers = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $villagers;
}

function get($key) {
    if(isset($_GET[$key]))
        return $_GET[$key];
    else
        return '';
}
