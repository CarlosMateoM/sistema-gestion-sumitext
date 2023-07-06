<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class DesignController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Designs/DesignsView');
    }
}
