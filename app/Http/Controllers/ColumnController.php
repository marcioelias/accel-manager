<?php

namespace App\Http\Controllers;

use App\Column;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    public function getColumns() {
        return response()->json(Column::all());
    }
}
