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
        if (StudentsModel::verifyToken(Request::getHeader("email"), Request::getHeader("auth_token"))){
            $code = 200;
            $result = BooksModel::getAllBooks();
        } else {
            $code = 401;
        }
        
        http_response_code($code);
        $this->View->renderJSON($result);
    }
    
    public function searchBook($key) {
        $result = NULL;
        $code = 200;
        if (StudentsModel::verifyToken(Request::getHeader("email"), Request::getHeader("auth_token"))){
            $code = 200;
            $result = BooksModel::getBookByKey($key);
        } else {
            $code = 401;
        }
        
        http_response_code($code);
        $this->View->renderJSON($result);
    }
    
}
