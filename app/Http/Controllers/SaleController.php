<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Controllers\iCRUD;

class SaleController extends Controller implements ICRUD
{
    //
    public function list()
    {
        $list = Sale::all();
        return view('be.sale.list', compact('list'));
    }

    public function add()
    {
        return view('be.sale.add');
    }

    public function doAdd(Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            Sale::create($data);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', "Thêm thất bại" . $exception->getMessage());
        }
        return redirect()->route('admin.sale.list')->with('success', 'Thêm thành công');
    }

    public function edit($id)
    {
        $data = Sale::find($id);
        return view('be.sale.edit', compact('data'));
    }

    public function doEdit(Request $request)
    {
        try {
            $data = $request->all();
            unset($data['_token']);
            Sale::where('id', $data['id'])->update($data);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', "Sửa thất bại");
        }
        return redirect()->route('admin.sale.list')->with('success', 'Sửa thành công');
    }

    public function delete($id)
    {
        try {
            Sale::where('id', $id)->delete();
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', "Xóa thất bại");
        }
        return redirect()->back()->with('success', "Xóa thành công");
    }
}
