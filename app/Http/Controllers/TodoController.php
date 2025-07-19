<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        return "Search query: " . $search; // VULNERABLE to XSS
    }
}
