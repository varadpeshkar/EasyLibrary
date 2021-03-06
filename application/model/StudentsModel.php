<?php

class StudentsModel {

    public static function getAllStudents($year) {
        $database = DatabaseFactory::getFactory()->getConnection();
        if ($year == "All") {
            $sql = "SELECT * FROM students ORDER BY timestamp DESC";
            $query = $database->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } else {
            $sql = "SELECT * FROM students WHERE current_year=:year ORDER BY timestamp DESC";
            $query = $database->prepare($sql);
            $query->execute(array(':year' => $year));
            return $query->fetchAll();
        }
    }

    public static function getStudentById($id) {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM students WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));
        return $query->fetch();
    }

    public static function importStudentsFromExcel() {
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        if (isset($_FILES['students_excel'])) {
            $inputFile = $_FILES['students_excel']['tmp_name'];
            return self::addStudentsFromExcel($inputFile);
        } else {
            return false;
        }
    }

    public static function addStudentsFromExcel($inputFile) {
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
                $sql = "INSERT INTO students (name, current_year, branch,mobile_number, email,password,status)
                    VALUES (:name, :current_year, :branch, :mobile_number, :email, :password, :status)";
                $query = $database->prepare($sql);
                $query->execute(array(':name' => $rowData[0],
                    ':current_year' => $rowData[1],
                    ':branch' => $rowData[2],
                    ':mobile_number' => $rowData[3],
                    ':email' => $rowData[4],
                    ':password' => $rowData[5],
                    ':status' => $rowData[6]
                ));
                $count = $query->rowCount();
                if ($count == 1) {
                    continue;
                } else {
                    return false;
                }
            }
        }

        return true;
    }

    public static function addNewStudents() {
        $name = strip_tags(Request::post('name'));
        $current_year = strip_tags(Request::post('current_year'));
        $branch = strip_tags(Request::post('branch'));
        $mobile_number = strip_tags(Request::post('mobile_number'));
        $email = strip_tags(Request::post('email'));
        $password = strip_tags(Request::post('password'));
        $status = 1;

        return self::writeNewStudent($name, $current_year, $branch, $mobile_number, $email, $password, $status);
    }

    public static function writeNewStudent($name, $current_year, $branch, $mobile_number, $email, $password, $status) {
        $database = DatabaseFactory::getFactory()->getConnection();

        // write new users data into database
        $sql = "INSERT INTO students (name, current_year, branch,mobile_number, email,password,status)
                    VALUES (:name, :current_year, :branch, :mobile_number, :email, :password, :status)";
        $query = $database->prepare($sql);
        $query->execute(array(':name' => $name,
            ':current_year' => $current_year,
            ':branch' => $branch,
            ':mobile_number' => $mobile_number,
            ':email' => $email,
            ':password' => $password,
            ':status' => $status
        ));


        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }

        return false;
    }

    public static function updateStudent($id) {
        $name = strip_tags(Request::post('name'));
        $current_year = strip_tags(Request::post('current_year'));
        $branch = strip_tags(Request::post('branch'));
        $mobile_number = strip_tags(Request::post('mobile_number'));

        return self::udpateStudentDetails($id, $name, $current_year, $branch, $mobile_number);
    }

    public static function udpateStudentDetails($id, $name, $current_year, $branch, $mobile_number) {
        $database = DatabaseFactory::getFactory()->getConnection();

        // write new users data into database
        $sql = "UPDATE students SET name=:name, current_year=:current_year, branch=:branch,mobile_number=:mobile_number WHERE id=:id";
        $query = $database->prepare($sql);
        $query->execute(array(':name' => $name,
            ':current_year' => $current_year,
            ':branch' => $branch,
            ':mobile_number' => $mobile_number,
            ':id' => $id
        ));


        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }

        return false;
    }

    public static function authenticate($email, $password) {
        $database = DatabaseFactory::getFactory()->getConnection();
        $result = new stdClass();
        if (empty($email) || empty($password)) {
            $result->success = false;
            $result->code = 401;
            $result->message = "Email or Password cannot be empty";
            return $result;
        }

        $student = self::getStudentByEmail($email);

        if ($student->password === $password) {
            $sha = mt_rand(1, 90000) . $student->name;
            $sha = sha1($sha);
            $sql = "UPDATE students SET auth_token = :sha WHERE email = :email";
            $query = $database->prepare($sql);
            $query->execute(array(':email' => $email, ':sha' => $sha));
            if ($query->rowCount() == 1) {
                $result->success = true;
                $result->code = 200;
                $result->auth_token = $sha;
            } else {
                $result->success = false;
                $result->code = 500;
                $result->message = "Unable to update user data.";
            }
        } else {
            $result->success = false;
            $result->code = 401;
            $result->message = "Email or Password is wrong.";
        }

        return $result;
    }

    public static function getStudentByEmail($email) {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM students WHERE email = :email LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':email' => $email));
        $student = $query->fetch();
        return $student;
    }
    
    public static function verifyToken($email, $token) {
        $student = self::getStudentByEmail($email);
        if ($student->auth_token == $token) {
            return TRUE;
        }
        return FALSE;
    }

    public static function requestBookIssue($data) {
        $book_id = $data['book_id'];
        $student_id = $data['user_id'];
        $status = "Pending";
        $result = new stdClass();

        $issued_books_count = sizeof(self::getIssueBooksForStudent($student_id));

        if ($issued_books_count == 3) {
            $result->success = false;
            $result->error_msg = "You have already requested for 3 books";
            $result->code = 200;
            return $result;
        }

        $issue_date = date("Y-m-d");
        $expiry_date = date('Y-m-d', strtotime(' + 15 days'));

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO students_books (user_id,book_id,issue_date,expiry_date,status)
                    VALUES (:user_id, :book_id, CAST(:issue_date AS DATE),CAST( :expiry_date AS DATE), :status)";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $student_id,
            ':book_id' => $book_id,
            ':issue_date' => $issue_date,
            ':expiry_date' => $expiry_date,
            ':status' => $status
        ));

        $count = $query->rowCount();


        if ($count == 1) {
            $lastInsertId = $database->lastInsertId();
            $result = self::getIssueBookForStudentById($lastInsertId);
            $result->code = 200;
            $result->success = true;
            $result->error_msg = "";
            return $result;
        } else {
            $result->success = false;
            $result->error_msg = "Failed to issue";
            $result->code = 200;
            return $result;
        }
    }

    public static function getIssueBookForStudentById($id) {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM students_books WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        $request = $query->fetch();
        $book = BooksModel::getBookById($request->book_id);
        $request->book = $book;
        return $request;
    }

    public static function getIssueBooksForStudent($id) {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM students_books WHERE user_id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));
        return $query->fetchAll();
    }

    public static function getAllIssueBookRequests() {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM students_books WHERE status='Pending' ORDER BY timestamp DESC";
        $query = $database->prepare($sql);
        $query->execute();
        $all_requests = array();

        foreach ($query->fetchAll() as $request) {
            array_walk_recursive($request, 'Filter::XSSFilter');
            $student = self::getStudentById($request->user_id);
            $book = BooksModel::getBookById($request->book_id);
            $request->student_name = $student->name;
            $request->student_year = $student->current_year;
            $request->student_email = $student->email;
            $request->book_name = $book->name;
            $request->book_isbn = $book->isbn;
            array_push($all_requests, $request);
        }

        return $all_requests;
    }

    public static function getAllIssuedBooks() {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM students_books WHERE status='Approved' ORDER BY timestamp DESC";
        $query = $database->prepare($sql);
        $query->execute();
        $all_requests = array();

        foreach ($query->fetchAll() as $request) {
            array_walk_recursive($request, 'Filter::XSSFilter');
            $student = self::getStudentById($request->user_id);
            $book = BooksModel::getBookById($request->book_id);
            $request->student_name = $student->name;
            $request->student_year = $student->current_year;
            $request->student_email = $student->email;
            $request->book_name = $book->name;
            $request->book_isbn = $book->isbn;
            array_push($all_requests, $request);
        }

        return $all_requests;
    }

    public static function approveBookRequest($id) {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM students_books WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        $request = $query->fetch();

        $current_count = BooksModel::getBookCurrentCount($request->book_id);

        if ($current_count == 0) {
            $status = "Rejected";
        } else {
            $status = "Approved";
            BooksModel::reduceCurrentBookCount($request->book_id);
        }

        $sql_update_status = "UPDATE students_books SET status=:status WHERE id= :id";
        $query_update = $database->prepare($sql_update_status);

        $query_update->execute(array(':id' => $id,
            ':status' => $status));
        $count_query = $query_update->rowCount();
        if ($count_query == 1 && $status == "Approved") {
            return true;
        }
        return false;
    }

    public static function renewBook($id) {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM students_books WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        $request = $query->fetch();

        $current_expiry_date = $request->expiry_date;

        $new_expiry_date = date('Y-m-d', strtotime($current_expiry_date . ' + 15 days'));

        $sql_update_expiry = "UPDATE students_books SET expiry_date = CAST(:new_expiry_date AS DATE) WHERE id= :id";
        $query_update = $database->prepare($sql_update_expiry);

        $query_update->execute(array(':id' => $id,
            ':new_expiry_date' => $new_expiry_date));
        $count_query = $query_update->rowCount();
        if ($count_query == 1) {
            return true;
        }
        return false;
    }

    public static function returnBook($id) {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM students_books WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        $request = $query->fetch();

        $increase = BooksModel::increaseCurrentBookCount($request->book_id);

        if ($increase) {
            $sql_delete = "DELETE FROM students_books WHERE id = :id";
            $query = $database->prepare($sql_delete);
            $query->execute(array(':id' => $id));
            $count_query = $query->rowCount();
            if ($count_query == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function getAllRequests($email) {
        $student = self::getStudentByEmail($email);

        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM students_books WHERE user_id = :student_id";
        $query = $database->prepare($sql);
        $query->execute(array(':student_id' => $student->id));
        $all_request = array();

        foreach ($query->fetchAll() as $request) {
            $book = BooksModel::getBookById($request->book_id);
            $request->book = $book;
            array_push($all_request, $request);
        }

        return $all_request;
    }

    public static function getStatistics() {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql_students = "SELECT * FROM students";
        $sql_books = "SELECT * FROM books";
        $sql_pending_requests = "SELECT * FROM students_books WHERE status='Pending'";
        $sql_issued_requests = "SELECT * FROM students_books WHERE status='Approved'";

        $query_students = $database->prepare($sql_students);
        $query_students->execute();
        $students_count = $query_students->rowCount();

        $query_books = $database->prepare($sql_books);
        $query_books->execute();
        $books_count = $query_books->rowCount();

        $query_pending = $database->prepare($sql_pending_requests);
        $query_pending->execute();
        $pending_count = $query_pending->rowCount();

        $query_issued = $database->prepare($sql_issued_requests);
        $query_issued->execute();
        $issued_count = $query_issued->rowCount();

        $stats = new stdClass();
        $stats->students = $students_count;
        $stats->books = $books_count;
        $stats->pending = $pending_count;
        $stats->issued = $issued_count;

        return $stats;
    }

}
