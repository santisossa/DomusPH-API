<?php
// Routes
$app->get('/[{name}]', function ($request, $response, $args) {
    $this->logger->info("Implement logs in routes");
    $db = $this->db;
    $args['name'] =$this->models->test::all()->toJson();
    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});