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

    public function addBooksBulk() {
        $this->View->render('index/addBooksBulk');
    }

    public function addStudents() {
        $this->View->render('index/addStudents');
    }

    public function bookDetails($bookId) {
        if ($bookId == null) {
            $this->View->render("index");
        } else {
            $this->View->render("index/bookDetails", array(
                'book' => BooksModel::getBookById($bookId)));
        }
    }

    public function downloadFormat() {
        Redirect::to('public/downloads/books_bulk_import.xlsx');
    }

    public function addBooksBulk_action() {
        $addBook = BooksModel::importBooksFromExcel();
        if ($addBook) {
            Redirect::to('index/books');
        }
    }

    public function addBook_action() {
        $addBook = BooksModel::addNewBooks();
        if ($addBook) {
            Redirect::to('index/books');
        }
    }

    public function addStudent_action() {
        $addStudent = StudentsModel::addNewStudents();
        if ($addStudent) {
            Redirect::to('index/students');
        }
    }
    
    public function addStudentsBulk() {
        $this->View->render('index/addStudentsBulk');
    }
   
    public function addStudentsBulk_action() {
        $addStudents = StudentsModel::importStudentsFromExcel();
        if ($addStudents) {
            Redirect::to('index/students');
        }
    }

    
    public function students() {
        $this->View->render('index/students', array('students' => StudentsModel::getAllStudents()));
    }

}
