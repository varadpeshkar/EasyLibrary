<?php

class StudentsModel {

    public static function getAllStudents() {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM students ORDER BY timestamp DESC";

        $query = $database->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public static function getStudentById($id) {
        $database = DatabaseFactory::getFactory()->getConnection();
        $sql = "SELECT * FROM students WHERE id = :id LIMIT 1";
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
                $data = new stdClass();
                $data->auth_token = $sha;
                $result->data = $data;
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

}
