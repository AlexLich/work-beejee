<?php
namespace App\Controller;

use App\Core\Controller;
use App\Service\CommentsService;
//use App\Service\AuthService;
use App\Model\Comment;

class CommentsController extends Controller
{
    /*protected $authService;*/
    protected $commentsService;

    function __construct()
    {
        parent::__construct();
        $this->commentsService = new CommentsService();
        /*$this->authService = new AuthService();*/
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
        /*$this->view->render('comments.html.twig');*/
        header("Location:/");
    }

    public function index()
    {
        $comments = $this->commentsService->getAll();
        $data = array('comments' => $comments);
        $this->view->render('comments.html.twig', $data);
    }

    public function descname()
    {
        $comments = $this->commentsService->sortdecsname();
        $data = array('comments' => $comments);
        $this->view->render('comments.html.twig', $data);
    }

    public function ascname()
    {
        $comments = $this->commentsService->sortacsname();
        $data = array('comments' => $comments);
        $this->view->render('comments.html.twig', $data);
    }

    public function descemail()
    {
        $comments = $this->commentsService->sortdecsemail();
        $data = array('comments' => $comments);
        $this->view->render('comments.html.twig', $data);
    }

    public function ascemail()
    {
        $comments = $this->commentsService->sortacsemail();
        $data = array('comments' => $comments);
        $this->view->render('comments.html.twig', $data);
    }

    public function descdate()
    {
        $comments = $this->commentsService->sortdecsdate();
        $data = array('comments' => $comments);
        $this->view->render('comments.html.twig', $data);
    }

    public function ascdate()
    {
        $comments = $this->commentsService->sortacsdate();
        $data = array('comments' => $comments);
        $this->view->render('comments.html.twig', $data);
    }
}
