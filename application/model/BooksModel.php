<?php

class BooksModel {

    public static function getAllBooks() {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM books";

        $query = $database->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public static function addNewBooks() {
        $isbn = strip_tags(Request::post('isbn_number'));
        $book = strip_tags(Request::post('book_name'));
        $author = strip_tags(Request::post('author_name'));
        $publisher = strip_tags(Request::post('publisher_name'));
        $department = strip_tags(Request::post('department_name'));

        return self::writeNewBook($isbn, $book, $author, $publisher, $department);
    }

    public static function writeNewBook($isbn, $book, $author, $publisher, $department) {
        $database = DatabaseFactory::getFactory()->getConnection();

        // write new users data into database
        $sql = "INSERT INTO books (isbn, name, author, publisher, department)
                    VALUES (:isbn, :name, :author, :publisher, :department)";
        $query = $database->prepare($sql);
        $query->execute(array(':isbn' => $isbn,
            ':name' => $book,
            ':author' => $author,
            ':publisher' => $publisher,
            ':department' => $department
        ));
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

}
