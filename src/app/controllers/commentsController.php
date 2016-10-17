<?php
namespace App\Controller;

use App\Core\Controller;
use App\Service\CommentsService;
use App\Service\AuthService;
use App\Model\Comment;

class CommentsController extends Controller
{
    protected $authService;
    protected $commentsService;

    function __construct($context)
    {
        parent::__construct($context);
        $this->commentsService = new CommentsService();
        $this->authService = new AuthService();
    }

    public function add()
    {
        $email = $_POST['exampleInputEmail'];
        $username = $_POST['exampleInputName'];
        $body = $_POST['text'];


        $comments = new Comment();

        $comments->email = $email;
        $comments->username = $username;
        $comments->body = $body;

        $this->commentsService->add($comments);
        header("Location:/");
    }

    public function index()
    {
        $isAuth = $this->authService->isAuth();

        $query = $this->context->getQueries();

        $sort = isset($query['sort']) ? $query['sort'] : "created_at";
        $orderby = isset($query['orderby']) ? $query['orderby'] : "desc";

        $comments = $this->commentsService->getAll($sort, $orderby);

        #при вызове getall ошибка, но код будет дальше или хз, или предупредить клиенту что не нашли или упс.

        $data = array('comments' => $comments, 'isAuth' => $isAuth);
        $this->view->render('comments.html.twig', $data);
    }

    public function edit()
    {
        $isAuth = $this->authService->isAuth();

        $params = $this->context->getParams();

        $id = $params['id'];


        $comment=$this->commentsService->getById($id);

        $data = array('comment' => $comment, 'isAuth' => $isAuth);

        if ($isAuth) {
            $this->view->render('edit.html.twig', $data);
        }else {
            $this->view->render('login.html.twig');
        }

    }

    public function update()
    {
        $changed_by_admin=0;

        $params = $this->context->getParams();

        $id = $params['id'];


        $fcomment=$this->commentsService->getById($id);

        $id = $params['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $body = $_POST['body'];
        $accepted= (int) (isset($_POST['accepted']) && $_POST['accepted'] == 'on');

        $comment = new Comment();

        $comment->id = $id;
        $comment->username = $username;
        $comment->email = $email;
        $comment->body = $body;
        $comment->accepted = $accepted;

        if ($fcomment->changed_by_admin==1) {
            $changed_by_admin=1;
        }else {
            if ($fcomment->body!=$comment->body){
                $changed_by_admin=1;
            }
            if ($fcomment->email!=$comment->email ){
                $changed_by_admin=1;
            }
            if($fcomment->username!=$comment->username){
                $changed_by_admin=1;
            }
        }

        $count = $this->commentsService->update($comment,$changed_by_admin);
        header("Location:/");
    }

}
