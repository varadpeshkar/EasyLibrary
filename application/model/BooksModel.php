<?php

class BooksModel {

    public static function getAllBooks() {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM books ORDER BY timestamp DESC";
        $query = $database->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public static function getAllBooksAPI() {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM books ORDER BY timestamp DESC";
        $query = $database->prepare($sql);
        $query->execute();
        $all_books = array();

        foreach ($query->fetchAll() as $book) {
            array_walk_recursive($book, 'Filter::XSSFilter');
            $book->location = self::getBookLocationById($book->id);
            array_push($all_books, $book);
        }

        return $all_books;
    }

    public static function getBookById($id) {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM books WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));
        $book = $query->fetch();

        $sql_location = "SELECT * FROM location WHERE book_id = :id LIMIT 1";
        $query_location = $database->prepare($sql_location);
        $query_location->execute(array(':id' => $book->id));
        $book_location = $query_location->fetch();
        $book->location = $book_location;
        array_walk_recursive($book, 'Filter::XSSFilter');

        return $book;
    }

    public static function getBookLocationById($id) {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql_location = "SELECT * FROM location WHERE book_id = :id LIMIT 1";
        $query_location = $database->prepare($sql_location);
        $query_location->execute(array(':id' => $id));
        return $query_location->fetch();
    }

    public static function getBookByKey($key) {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM books WHERE name LIKE :key OR author LIKE :key OR publisher LIKE :key OR department LIKE :key";
        $query = $database->prepare($sql);
        $query->execute(array(':key' => '%'. $key . '%'));
        $all_books = array();

        foreach ($query->fetchAll() as $book) {
            array_walk_recursive($book, 'Filter::XSSFilter');
            $book->location = self::getBookLocationById($book->id);
            array_push($all_books, $book);
        }

        return $all_books;
    }

    public static function getDepartments() {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT DISTINCT department FROM books";
        $query = $database->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public static function getBooksByDepartment($department) {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM books WHERE department LIKE :department";
        $query = $database->prepare($sql);
        $query->execute(array(':department' => '%'. $department . '%'));
        $all_books = array();

        foreach ($query->fetchAll() as $book) {
            array_walk_recursive($book, 'Filter::XSSFilter');
            $book->location = self::getBookLocationById($book->id);
            array_push($all_books, $book);
        }

        return $all_books;
    }

    public static function importBooksFromExcel() {
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        if (isset($_FILES['books_excel'])) {
            $inputFile = $_FILES['books_excel']['tmp_name'];
            return self::addBooksFromExcel($inputFile);
        } else {
            return false;
        }
    }

    public static function addBooksFromExcel($inputFile) {
        $database = DatabaseFactory::getFactory()->getConnection();
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFile);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        //Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        //Loop through each row of the worksheet in turn
        for ($row = 2; $row <= $highestRow; $row++) {
            $regId;
            $rank;
            for ($col = 0; $col < $highestColumnIndex; $col++) {
                $rowData[$col] = $sheet->getCellByColumnAndRow($col, $row)->getValue();
            }
            if ($rowData[0] != null && $rowData[1] != null) {
                $sql = "INSERT INTO books (isbn, name, author, publisher, department, tags)
                    VALUES (:isbn, :name, :author, :publisher, :department, :tags)";
                $query = $database->prepare($sql);
                $query->execute(array(':isbn' => $rowData[0],
                    ':name' => $rowData[1],
                    ':author' => $rowData[2],
                    ':publisher' => $rowData[3],
                    ':department' => $rowData[4],
                    ':tags' => $rowData[5]
                ));
                $count = $query->rowCount();
                if ($count == 1) {
                    $bookId = $database->lastInsertId();
                    $sql_location = "INSERT INTO location (book_id, section, shelf, row, column1, current_count)
                    VALUES (:book_id, :section, :shelf, :row, :column, :current_count)";
                    $query_location = $database->prepare($sql_location);
                    $query_location->execute(array(':book_id' => $bookId,
                        ':section' => $rowData[6],
                        ':shelf' => $rowData[7],
                        ':row' => $rowData[8],
                        ':column' => $rowData[9],
                        ':current_count' => $rowData[10],
                    ));
                    $count_location = $query_location->rowCount();
                    if ($count_location == 1) {
                        continue;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        }

        return true;
    }

    public static function addNewBooks() {
        $isbn = strip_tags(Request::post('isbn_number'));
        $book = strip_tags(Request::post('book_name'));
        $author = strip_tags(Request::post('author_name'));
        $publisher = strip_tags(Request::post('publisher_name'));
        $department = strip_tags(Request::post('department_name'));
        $tags = strip_tags(Request::post('tags'));
        $section = strip_tags(Request::post('section'));
        $shelf = strip_tags(Request::post('shelf'));
        $row = strip_tags(Request::post('row'));
        $column = strip_tags(Request::post('column'));
        $current_count = strip_tags(Request::post('current_count'));

        return self::writeNewBook($isbn, $book, $author, $publisher, $department, $tags, $section, $shelf, $row, $column, $current_count);
    }

    public static function writeNewBook($isbn, $book, $author, $publisher, $department, $tags, $section, $shelf, $row, $column, $current_count) {
        $database = DatabaseFactory::getFactory()->getConnection();

        // write new users data into database
        $sql = "INSERT INTO books (isbn, name, author, publisher, department, tags)
                    VALUES (:isbn, :name, :author, :publisher, :department, :tags)";
        $query = $database->prepare($sql);
        $query->execute(array(':isbn' => $isbn,
            ':name' => $book,
            ':author' => $author,
            ':publisher' => $publisher,
            ':department' => $department,
            ':tags' => $tags
        ));


        $count = $query->rowCount();
        if ($count == 1) {
            $bookId = $database->lastInsertId();
            $sql_location = "INSERT INTO location (book_id, section, shelf, row, column1, current_count)
                    VALUES (:book_id, :section, :shelf, :row, :column, :current_count)";
            $query_location = $database->prepare($sql_location);
            $query_location->execute(array(':book_id' => $bookId,
                ':section' => $section,
                ':shelf' => $shelf,
                ':row' => $row,
                ':column' => $column,
                ':current_count' => $current_count,
            ));
            $count_location = $query_location->rowCount();
            if ($count_location == 1) {
                return true;
            }
            return false;
        }
        return false;
    }

}
