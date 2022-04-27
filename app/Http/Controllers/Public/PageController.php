<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Page $page)
    {
        return $this->view('public.pages.show', [
            "title" => "$page->title",
            "page" => $page,
        ]);
    }
}
