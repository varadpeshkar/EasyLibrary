<?php

class IndexController extends Controller {

    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct() {
        parent::__construct();

        Auth::checkAuthentication();
    }

    /**
     * Handles what happens when user moves to URL/index/index - or - as this is the default controller, also
     * when user moves to /index or enter your application at base level
     */
    public function index() {
        $this->View->render('index/index');
    }

    public function books() {
        $this->View->render('index/index', array('books' => BooksModel::getAllBooks()));
    }

    public function addbook() {
        $this->View->render('index/index', array('addBook' => true));
    }

    public function addBook_action() {
        $addBook = BooksModel::addNewBooks();
        if ($addBook) {
            Redirect::to('index/books');
        }
    }

}
