<?php
namespace App\Service;

use App\Config\Connect;
use App\Service\AuthService;


use PDO;

class CommentsService
{
    protected $connect;

    function __construct()
    {
        $this->connect = new Connect();
        $this->authService = new AuthService();
    }

    public function getAll($sort, $orderby)
    {
        $isAuth = $this->authService->isAuth();
        $data = null;

        if ($isAuth) {
            $sql="SELECT username, body,email, created_at, accepted, changed_by_admin  FROM comments ORDER by $sort $orderby";
        }else {
            $sql="SELECT username, body,email, created_at, changed_by_admin  FROM comments WHERE accepted = 1 ORDER by $sort $orderby";
        }

        $pdo = $this->connect->getDb();
        if(!is_null($pdo)) {
            $data = $pdo->query($sql)->fetchAll(PDO::FETCH_CLASS, "App\\Model\\Comment");
            $pdo = null;
        }

        return $data;
    }

    public function add($comments)
    {
        $count = 0;
        $sql = 'INSERT INTO comments (username, email, body) VALUES (:username, :email, :body)';
        $pdo = $this->connect->getDb();
        if(!is_null($pdo)) {
            $sth = $pdo->prepare($sql);
            $count = $sth->execute(array(':username' => $comments->username,':email' => $comments->email, ':body' => $comments->body));
            $pdo = null;
        }
        return $count;
    }

}
