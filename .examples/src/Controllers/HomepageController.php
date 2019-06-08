<?php
namespace Example\App\Controllers;

use DevOp\Core\Framework\Controller;

class HomepageController extends Controller
{

    public function __invoke()
    {
        return new \DevOp\Core\Http\Response('Ok!');
    }
}
