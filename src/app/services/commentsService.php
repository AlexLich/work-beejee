<?php
namespace App\Service;

use App\Config\connect;
use App\Service\authService;
use App\Model\comment;


use PDO;

class CommentsService
{
    protected $connect;
    protected $imageService;

    public function __construct()
    {
        $this->connect = new Connect();

        $this->authService = new AuthService();
        $this->imageService = new ImageService();
    }

    public function getAll($sort, $orderby)
    {
        $isAuth = $this->authService->isAuth();
        $data = null;

        if ($isAuth) {
            $sql = "SELECT id, username, body,email, created_at, accepted, changed_by_admin, image
                    FROM comments
                    ORDER by $sort $orderby";
        } else {
            $sql = "SELECT username, body,email, created_at, changed_by_admin, image
                    FROM comments WHERE accepted=1
                    ORDER by $sort $orderby";
        }

        $pdo = $this->connect->getDb();
        if (!is_null($pdo)) {
            $data = $pdo->query($sql)->fetchAll(PDO::FETCH_CLASS, "App\\Model\\Comment");
            $pdo = null;
        }

        return $data;
    }

    public function add($comment)
    {
        $count = 0;

        $sql = 'INSERT INTO comments (username, email, body, image) VALUES (:username, :email, :body, :image)';
        $pdo = $this->connect->getDb();
        if (!is_null($pdo)) {
            $sth = $pdo->prepare($sql);
            $count = $sth->execute(array(
                ':username' => $comment->username,
                ':email' => $comment->email,
                ':body' => $comment->body,
                ':image' => $comment->image
            ));
            $pdo = null;
        }
        return $count;
    }

    public function getById($id)
    {

        $data = null;
        $sql = "SELECT id,username, body,email, created_at, changed_by_admin, accepted, image
                FROM comments
                WHERE id='$id'";

        $pdo = $this->connect->getDb();
        if (!is_null($pdo)) {
            $data = $pdo->query($sql)->fetch();
            $pdo = null;
        }

        $comments = new Comment();

        $comments->id = $data["id"];
        $comments->email = $data["email"];
        $comments->username = $data["username"];
        $comments->body = $data["body"];
        $comments->changed_by_admin = $data["changed_by_admin"];
        $comments->accepted = $data["accepted"];
        $comments->image = $data["image"];

        return $comments;
    }

    public function update($comment, $changed_by_admin)
    {
        $count = 0;

        $sql = "UPDATE comments
                set email=:email,
                    username=:username,
                    body=:body,
                    changed_by_admin=$changed_by_admin,
                    accepted=:accepted
                where id=:id";

        $pdo = $this->connect->getDb();

        if (!is_null($pdo)) {
            $sth = $pdo->prepare($sql);
            $count = $sth->execute(array(
                ':username' => $comment->username,
                ':email' => $comment->email,
                ':body' => $comment->body,
                'accepted'=> $comment->accepted,
                ':id' => $comment->id
            ));
            $pdo = null;
        }
        return $count;
    }
}
