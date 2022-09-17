<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/database.php';

/**
 * Retrieve this user's record
 * @param string $username the username to look up
 * @return false|mixed the record or false if the query fails
 */
function db_get_user(string $username) {
    global $DB;
    $reqUser = $DB->prepare('SELECT u.* FROM users u
        WHERE (u.username = ?)');
    $reqUser->execute([$username]);
    if ($reqUser->rowCount() != 1)
        return false;   // user not found / invalid
    return $reqUser->fetch();
}

/**
 * Create the user in the database and return their record
 * @param string $name_surname the user's full name
 * @param string $username the user's username
 * @param string $phone the user's phone number
 * @param string $password_hash hash of the user's password
 * @return false|mixed the user record or false if the operation fails
 */
function db_create_user(string $name_surname, string $username, string $phone,
                        string $password_hash) {
    global $DB;
    $stmt = $DB->prepare('INSERT INTO users (name_surname, username,
                   phone, password, identifier) VALUES (?, ?, ?, ?, ?)');
    $success = $stmt->execute([$name_surname, $username, $phone, $password_hash, uniqid()]);
    if ($success)
        return db_get_user($username);
    return false;
}

function db_get_place(int $place_id){
    global $DB;
    $reqUser = $DB->prepare('SELECT p.* FROM places p
        WHERE (p.id_place = ?)');
    $reqUser->execute([$place_id]);
    if ($reqUser->rowCount() != 1)
        return false;   // place not found / invalid
    return $reqUser->fetch();
}