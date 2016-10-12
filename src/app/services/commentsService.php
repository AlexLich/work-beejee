<?php
namespace App\Service;

use App\Config\Connect;
//use App\Model\CommentsModel;
use PDO;

class CommentsService
{
    protected $connect;

    function __construct()
    {
        $this->connect = new Connect();
    }

    public function getAll($sort, $orderby)
    {
        $data = null;
        $sql="SELECT username, body,email, created_at  FROM comments WHERE accepted = 1 ORDER by $sort $orderby";
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

//     public function sortdecsname()
//     {
//         $data = null;
//         $sql="SELECT username, body,email, created_at  FROM comments WHERE accepted = 1 ORDER by username desc";
//         $pdo = $this->connect->getDb();
//         if(!is_null($pdo)) {
//             $data = $pdo->query($sql)->fetchAll(PDO::FETCH_CLASS, "App\\Model\\Comment");
//             $pdo = null;
//         }
//
//         return $data;
//     }
//
//     public function sortacsname()
//     {
//         $data = null;
//         $sql="SELECT username, body,email, created_at  FROM comments WHERE accepted = 1 ORDER by username asc";
//         $pdo = $this->connect->getDb();
//         if(!is_null($pdo)) {
//             $data = $pdo->query($sql)->fetchAll(PDO::FETCH_CLASS, "App\\Model\\Comment");
//             $pdo = null;
//         }
//
//         return $data;
//     }
//
//     public function sortdecsemail()
//     {
//         $data = null;
//         $sql="SELECT username, body,email, created_at  FROM comments WHERE accepted = 1 ORDER by email desc";
//         $pdo = $this->connect->getDb();
//         if(!is_null($pdo)) {
//             $data = $pdo->query($sql)->fetchAll(PDO::FETCH_CLASS, "App\\Model\\Comment");
//             $pdo = null;
//         }
//
//         return $data;
//     }
//
//     public function sortacsemail()
//     {
//         $data = null;
//         $sql="SELECT username, body,email, created_at  FROM comments WHERE accepted = 1 ORDER by email asc";
//         $pdo = $this->connect->getDb();
//         if(!is_null($pdo)) {
//             $data = $pdo->query($sql)->fetchAll(PDO::FETCH_CLASS, "App\\Model\\Comment");
//             $pdo = null;
//         }
//
//         return $data;
//     }
//
//     public function sortdecsdate()
//     {
//         $data = null;
//         $sql="SELECT username, body,email, created_at  FROM comments WHERE accepted = 1 ORDER by created_at desc";
//         $pdo = $this->connect->getDb();
//         if(!is_null($pdo)) {
//             $data = $pdo->query($sql)->fetchAll(PDO::FETCH_CLASS, "App\\Model\\Comment");
//             $pdo = null;
//         }
//
//         return $data;
//     }
//
//     public function sortacsdate()
//     {
//         $data = null;
//         $sql="SELECT username, body,email, created_at  FROM comments WHERE accepted = 1 ORDER by created_at asc";
//         $pdo = $this->connect->getDb();
//         if(!is_null($pdo)) {
//             $data = $pdo->query($sql)->fetchAll(PDO::FETCH_CLASS, "App\\Model\\Comment");
//             $pdo = null;
//         }
//
//         return $data;
//     }
//
}
