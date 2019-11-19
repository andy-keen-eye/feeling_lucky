<?php
namespace lib;

class Model
{
    private $config;
    private $pdoConnection;

    public function __construct()
    {
       $this->config = parse_ini_file('../includes/config.ini', true);
       $this->pdoConnection = $this->pdoConnection();
    }

    /**
     * PDO-connection
     *
     * @return obj PDO
     */
    private function pdoConnection()
    {
        $pdoConnection = new \PDO('mysql:host=localhost;dbname='.$this->config['database'].';charset=utf8', $this->config['db_user'], $this->config['db_pass']);
        return ($pdoConnection);
    }

    //filling the users table
    public function insertUser($username, $phone_number, $link, $expire_date)
    {
        $sql = "INSERT INTO users (
            username,
            phone_number,
            link,
            expire_date
        ) VALUES (
            :username,
            :phone_number,
            :link,
            :expire_date
        )";
        $pdo = $this->pdoConnection->prepare($sql);

        $pdo->execute([
            'username' => $username,
            'phone_number' => $phone_number,
            'link' => $link,
            'expire_date' => $expire_date
        ]);
        return $this->pdoConnection->lastInsertId();
    }

    //select user data
    public function selectUser($user_id)
    {
        $dbh = $this->pdoConnection->prepare("SELECT * FROM users WHERE id = :user_id");
        $dbh->execute(['user_id' => $user_id]);

        $user = $dbh->fetch();
        return $user;
    }

    //update link
    public function updateLink($id, $unique_num, $expire_date)
    {
        $sql = "UPDATE users SET
            link = :unique_num,
            expire_date = :expire_date
            WHERE id = :id";
        $dbh = $this->pdoConnection->prepare($sql);
        $dbh->execute([
            'unique_num' => $unique_num,
            'expire_date' => $expire_date,
            'id' => $id
        ]);
        return;
    }

    //change expire date to current date
    public function deactivateLink($id, $expire_date)
    {
        $sql = "UPDATE users SET
            expire_date = :expire_date
            WHERE id = :id";
        $dbh = $this->pdoConnection->prepare($sql);
        $dbh->execute([
            'expire_date' => $expire_date,
            'id' => $id
        ]);
        return;
    }

    //update history data
    public function updateHistory($id, $feeling_lucky)
    {
        $sql = "UPDATE users SET
            feeling_lucky = :feeling_lucky
            WHERE id = :id";
        $dbh = $this->pdoConnection->prepare($sql);
        $dbh->execute([
            'feeling_lucky' => $feeling_lucky,
            'id' => $id
        ]);
        return;
    }

    public function selectAllUsers()
    {
        $dbh = $this->pdoConnection->prepare("SELECT * FROM users");
        $dbh->execute();
        $users = $dbh->fetchAll();
        return $users;
    }

    //update user
    public function updateUser($user, $expire_date)
    {
        $sql = "UPDATE users SET
            username = :username,
            phone_number = :phone_number,
            link = :link,
            expire_date = :expire_date
            WHERE id = :id";
        $dbh = $this->pdoConnection->prepare($sql);
        $dbh->execute([
            'username' => $user['username'],
            'phone_number' => $user['phone_number'],
            'link' => $user['edit_link'],
            'expire_date' => $expire_date,
            'id' => $user['user_id']
        ]);
        return;
    }

    //delete user
    public function deleteUser($user_id)
    {
        $sql = "DELETE FROM `users` WHERE id = :id";
        $dbh = $this->pdoConnection->prepare($sql);
        $dbh->execute(['id' => $user_id]);
        return;
    }

}