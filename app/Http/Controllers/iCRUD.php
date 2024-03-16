<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

interface iCRUD
{
    public function list();
    public function add();
    public function doAdd(Request $request);
    public function edit($id);
    public function doEdit(Request $request);
    public function delete(Request $request);
}
