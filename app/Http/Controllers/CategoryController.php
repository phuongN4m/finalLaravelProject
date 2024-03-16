<?php

namespace App\Http\Controllers;

use App\Http\Controllers\iCRUD as ControllersICRUD;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller implements ControllersICRUD
{
    public function list()
    {
        $list = Category::all();
        return view('be.category.list')->with('list', $list);
    }
    public function add()
    {
        return view('be.category.add');
    }
    public function doAdd(Request $request)

    {
        try {
            //code...
            $data = $request->all();
            unset($data['_token']);
            Category::create($data);
            $list = Category::all();
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Them that bai');
        }
        return view('be.category.list')->with(['list' => $list, 'success' => 'Them thanh cong']);
    }
    public function edit($id)
    {
        $data = Category::find($id);
        return view('be.category.edit')->with(['id' => $id, 'data' => $data]);
    }
    public function doEdit(Request $request)
    {
        dd($request->all());
        try {
            //code...
            $data = $request->all();
            unset($data['_token']);
            Category::where('id', '=', $data['id'])->update($data);
            dd($data);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back();
        }

        return view('be.category.edit');
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        Category::where('id', '=', $id)->delete();
        $list = Category::all();
        $msg = 'Delete the category with id = ' . $id;
        return view('be.category.list')->with(['msg' => $msg, 'list' => $list]);
    }
}
