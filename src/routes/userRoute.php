
<?php
use Src\Lib\Auth,
    Src\Lib\Response,
    Src\Validation\UserValidation;

$app->group('/users/', function () {
    $this->get('/[{name}]', function (Request $request, Response $response, array $args) {
        // Sample log message
        $this->logger->info("DomusPH-API '/' users");
    
        // Render index view
        return $this->renderer->render($response, 'index.phtml', $args);
    });
    $this->post('register', function ($req, $res, $args) {

        return $res
            ->withHeader('Content-type', 'application/json')
            ->write(
                json_encode($this->models->users->userRegister($req->getParsedBody()))
            );
    });
});