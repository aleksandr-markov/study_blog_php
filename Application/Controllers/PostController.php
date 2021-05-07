<?php


namespace Application\Controllers;


use Application\Models\PostModel;
use Core\Controller;

class PostController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->model = new PostModel();
    }

    public function index()
    {
        $this->view->generate('mainView.php', 'templateView.php', $this->model->index());
    }

    public function store()
    {
        $title = $_POST['title'];
        $text = $_POST['text'];

        echo json_encode($this->model->store($title, $text, $_SESSION['user']['id']));
    }

    public function create()
    {
        $data = ['count' => $this->model->countUserPosts($_SESSION['user']['id']), 'posts' => $this->model->getPostByUserId($_SESSION['user']['id'])];
        $this->view->generate("create-view.php", 'templateView.php', $data);
    }

    public function posts(int $id)
    {
        $this->view->generate('article-view.php', 'templateView.php', $this->model->getPostById($id), $this->model->commentView($this->model->getPostComment($id)));
    }

    public function edit(int $id)
    {
        $this->view->generate('edit-view.php', 'templateView.php', $this->model->getPostById($id));
    }


    public function update(int $id)
    {
        $this->model->update($_POST['title'], $_POST['text'], $id);
        header("Location: /posts/$id/show");
    }


    public function delete(int $id)
    {
        $this->model->delete($id);
        header("Location: /");
    }


    public function addComment()
    {
        var_dump($_POST);
        echo($this->model->addComment($_SESSION['user']['id'], $_POST['articleId'], trim($_POST['comment_content']), $_POST['parentId']));
    }


    public function userPosts(int $id)
    {
        $this->view->generate('user-article-view.php', 'templateView.php', $this->model->getPostByUserId($id));
    }

    public function fetchComments(int $id)
    {
        echo $this->model->commentView($this->model->getPostComment($id));
    }

}