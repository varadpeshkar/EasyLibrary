<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StudentsController
 *
 * @author chinmayg
 */
class StudentsController extends Controller {

    //put your code here

    public function authenticate() {
        $data = Request::postJson();
        $result = StudentsModel::authenticate($data['email'], $data['password']);
        http_response_code($result->code);
        $this->View->renderJSON($result);
    }

    public function getBooks() {
        $result = NULL;
        $code = 200;
        if (StudentsModel::verifyToken(Request::getHeader("email"), Request::getHeader("auth_token"))) {
            $code = 200;
            $result = BooksModel::getAllBooksAPI();
        } else {
            $code = 401;
        }

        http_response_code($code);
        $this->View->renderJSON($result);
    }

    public function status() {
        $code = 200;
        $result = new stdClass();
        $result->success = true;
        $result->code = 200;
        $result->message = "Okay";

        http_response_code($code);
        $this->View->renderJSON($result);
    }

    public function searchBook($key) {
        $result = NULL;
        $code = 200;
        if (StudentsModel::verifyToken(Request::getHeader("email"), Request::getHeader("auth_token"))) {
            $code = 200;
            $result = BooksModel::getBookByKey($key);
        } else {
            $code = 401;
        }

        http_response_code($code);
        $this->View->renderJSON($result);
    }

    public function getAllDepartments() {
        $result = NULL;
        $code = 200;
        if (StudentsModel::verifyToken(Request::getHeader("email"), Request::getHeader("auth_token"))) {
            $code = 200;
            $result = BooksModel::getDepartments();
        } else {
            $code = 401;
        }

        http_response_code($code);
        $this->View->renderJSON($result);
    }

    public function getBooksByDepartment($department) {
        $department = urldecode($department);
        $department = str_replace(",", " ", $department);
        $result = NULL;
        $code = 200;
        if (StudentsModel::verifyToken(Request::getHeader("email"), Request::getHeader("auth_token"))) {
            $code = 200;
            $result = BooksModel::getBooksByDepartment($department);
        } else {
            $code = 401;
        }

        http_response_code($code);
        $this->View->renderJSON($result);
    }

    public function getRecommendations() {
        $result = NULL;
        $code = 200;
        $email = Request::getHeader("email");
        if (StudentsModel::verifyToken(Request::getHeader("email"), Request::getHeader("auth_token"))) {
            $code = 200;
            $result = BooksModel::getBookRecommendations($email);
        } else {
            $code = 401;
        }

        http_response_code($code);
        $this->View->renderJSON($result);
    }

    public function getProfile() {
        $result = NULL;
        $code = 200;
        $email = Request::getHeader("email");
        if (StudentsModel::verifyToken(Request::getHeader("email"), Request::getHeader("auth_token"))) {
            $code = 200;
            $result = StudentsModel::getStudentByEmail($email);
        } else {
            $code = 401;
        }

        http_response_code($code);
        $this->View->renderJSON($result);
    }

    public function requestBookIssue() {
        $result = NULL;
        $code = 200;
        $data = Request::postJson();
        if (StudentsModel::verifyToken(Request::getHeader("email"), Request::getHeader("auth_token"))) {
            $result = StudentsModel::requestBookIssue($data);
            $code = $result->code;
        } else {
            $code = 401;
        }

        http_response_code($code);
        $this->View->renderJSON($result);
    }

    public function getAllBookIssueRequests() {
        $result = new stdClass();
        $code = 200;
        $email = Request::getHeader("email");
        if (StudentsModel::verifyToken(Request::getHeader("email"), Request::getHeader("auth_token"))) {
            $result = StudentsModel::getAllRequests($email);
        } else {
            $code = 401;
        }

        http_response_code($code);
        $this->View->renderJSON($result);
    }

}
