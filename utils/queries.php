<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/database.php';

/**
 * Retrieve this user's record
 * @param string $username the username to look up
 * @return false|mixed the record or false if the query fails
 */
function db_get_user_by_username(string $username) {
    global $DB;
    $reqUser = $DB->prepare('SELECT u.* FROM users u
        WHERE (u.username = ?)');
    $reqUser->execute([$username]);
    if ($reqUser->rowCount() != 1)
        return false;   // user not found / invalid
    return $reqUser->fetch();
}

/**
 * Retrieve this user's record
 * @param string $identifier the user's identifier to look up
 * @return false|mixed the record or false if the query fails
 */
function db_get_user_by_identifier(string $identifier) {
    global $DB;
    $reqUser = $DB->prepare('SELECT u.* FROM users u
        WHERE (u.identifier = ?)');
    $reqUser->execute([$identifier]);
    if ($reqUser->rowCount() != 1)
        return false;   // user not found / invalid
    return $reqUser->fetch();
}

/**
 * Retrieve this user's record
 * @param int $userId user's database ID
 * @return false|mixed the record or false if the query fails
 */
function db_get_user(int $userId) {
    global $DB;
    $reqUser = $DB->prepare('SELECT u.* FROM users u
        WHERE (u.id_user = ?)');
    $reqUser->execute([$userId]);
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
        return db_get_user_by_username($username);
    return false;
}

function db_add_user_contact(int $userId, int $targetUserId): bool {
    global $DB;
    $stmt = $DB->prepare('INSERT INTO friendships (id_user1, id_user2) VALUES (?, ?)');
    return $stmt->execute([$userId, $targetUserId]);
}

function db_remove_user_contact(int $userId, int $targetUserId): bool {
    global $DB;
    $stmt = $DB->prepare('DELETE FROM friendships
       WHERE (id_user1 = ?) AND (id_user2 = ?)');
    return $stmt->execute([$userId, $targetUserId]);
}

function db_user_is_contact(int $userId, int $targetUserId): bool {
    global $DB;
    $stmt = $DB->prepare('SELECT id_friendship FROM friendships WHERE id_user1 = ? AND id_user2 = ?');
    if (!$stmt->execute([$userId, $targetUserId]))
        return false;
    return $stmt->rowCount() > 0;
}

function db_get_place(int $place_id) {
    global $DB;
    $reqUser = $DB->prepare('SELECT p.* FROM places p
        WHERE (p.id_place = ?)');
    $reqUser->execute([$place_id]);
    if ($reqUser->rowCount() != 1)
        return false;   // place not found / invalid
    return $reqUser->fetch();
}

function db_update_file_path(int $user_id) {
    global $DB;
    $target_dir = "uploads/";
    if (!file_exists($target_dir))  // because it doesn't exist in the source package
        mkdir($target_dir);
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
    $stmt = $DB->prepare('UPDATE users SET image_path = ? WHERE id_user = ?');
    $stmt->execute([$target_file, $user_id]);
}

function db_get_friendship(int $user_id) {
    global $DB;
    $reqUser = $DB->prepare('SELECT u.* FROM users u
        INNER JOIN friendships f ON f.id_user2 = u.id_user
        WHERE f.id_user1 = ?');
    if (!$reqUser->execute([$user_id]))
        return false;
    return $reqUser->fetch();
}