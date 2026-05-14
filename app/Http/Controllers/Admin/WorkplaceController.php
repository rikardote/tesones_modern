<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workplace;
use Illuminate\Http\Request;

class WorkplaceController extends Controller
{
    public function index()
    {
        return view('admin.workplaces.index');
    }

    public function create()
    {
        return view('admin.workplaces.create');
    }

    public function edit(Workplace $workplace)
    {
        return view('admin.workplaces.edit', compact('workplace'));
    }
}
