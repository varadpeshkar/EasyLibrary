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
        $result = new stdClass();
        
        if (StudentsModel::verifyToken(Request::getHeader("email"), Request::getHeader("auth_token"))){
            $result->succss = TRUE;
        } else {
            $result->succss = FALSE;
        }
        
        
        $this->View->renderJSON($result);
    }
    
}
