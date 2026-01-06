<?php

namespace App\Controller;

use http\Env\Response;

class DefaultController {
    public function index() {
        new Response("<p>Hello Im Shinobi</p>");
    }
}
