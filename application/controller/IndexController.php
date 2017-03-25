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
        $this->View->render('index/dashboard', array('stats' => StudentsModel::getStatistics()));
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
            Redirect::to('index/students/All');
        }
    }

    public function addStudentsBulk() {
        $this->View->render('index/addStudentsBulk');
    }

    public function addStudentsBulk_action() {
        $addStudents = StudentsModel::importStudentsFromExcel();
        if ($addStudents) {
            Redirect::to('index/students/All');
        }
    }

    public function students($year) {
        $this->View->render('index/students', array('students' => StudentsModel::getAllStudents($year), 'year' => $year));
    }

    public function pendingRequests() {
        $this->View->render('index/pendingRequests', array('requests' => StudentsModel::getAllIssueBookRequests()));
    }

    public function issuedBooks() {
        $this->View->render('index/issuedBooks', array('requests' => StudentsModel::getAllIssuedBooks()));
    }

    public function approveBookRequest($id) {
        $approve = StudentsModel::approveBookRequest($id);
        if ($approve) {
            Redirect::to('index/pendingRequests?approved=true');
        } else {
            Redirect::to('index/pendingRequests?approved=false');
        }
    }

    public function renewBook($id) {
        $approve = StudentsModel::renewBook($id);
        if ($approve) {
            Redirect::to('index/issuedBooks?renewed=true');
        } else {
            Redirect::to('index/issuedBooks?renewed=false');
        }
    }

    public function returnBook($id) {
        $approve = StudentsModel::returnBook($id);
        if ($approve) {
            Redirect::to('index/issuedBooks?returned=true');
        } else {
            Redirect::to('index/issuedBooks?returned=false');
        }
    }

    public function editStudent($id) {
        $student = StudentsModel::getStudentById($id);
        $this->View->render('index/editStudent', array('student' => $student));
    }

    public function editStudent_action($id) {
        $student = StudentsModel::updateStudent($id);
        if ($student) {
            Redirect::to('index/students/All');
        } else {
            Redirect::to('index/editStudent/' . $id);
        }
    }

    public function editBookDetails($id) {
        $book = BooksModel::getBookById($id);
        $this->View->render("index/editBookDetails", array('book' => $book));
    }

    public function editBook_action($id) {
        $student = BooksModel::editBookDetails($id);
        if ($student) {
            Redirect::to('index/bookDetails/' . $id);
        } else {
            Redirect::to('index/editBookDetails/' . $id);
        }
    }

}
