
<?php

use Src\Controllers\UserController;

$app->group('/users/', function () {
    
    $this->post('register', function ($req, $res, $args) {

        var_dump($req->getParsedBody());
        exit;
        $users = new UserController($this->db);
        $user = json_encode($req->getParsedBody());
        $this->logger->info("user created / {$user}");
        return $res
            ->withHeader('Content-type', 'application/json')
            ->write($users->insertUser($req->getParsedBody()));
    });

    $this->get('getUsers', function ($req, $res, $args) {

        $users = new UserController($this->db);
        $this->logger->info("getUsers / {$users->getUsers()}");
        return $res
            ->withHeader('Content-type', 'application/json')
            ->write($users->getUsers());
    });

    $this->post('createTableUsers', function ($req, $res, $args) {

        $users = new UserController($this->db);
        $this->logger->info("se creo la tabla users");
        return $res
            ->withHeader('Content-type', 'application/json')
            ->write($users->createTableUsers($req->getParsedBody()));
    });
});