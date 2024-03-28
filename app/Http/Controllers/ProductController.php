<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\iCRUD;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller implements iCRUD
{
    //
    public function list()
    {
        $list = Product::all();
        return view('be.product.list', compact('list'));
    }

    public function add()
    {
        $categories = Category::all();
        $sales = Sale::all();
        return view('be.product.add', compact('categories', 'sales'));
    }

    public function doAdd(Request $request)
    {

        try {
            DB::beginTransaction();
            $data = $request->all();
            $files = $data['img'];
            unset($data['_token']);
            unset($data['img']);
            $product = Product::create($data);
            if ($files && count($files) > 0) {
                for ($i = 0; $i < count($files); $i++) {
                    $fileName = time() . $i . $files[$i]->getClientOriginalName();
                    $files[$i]->storeAs('/product', $fileName, 'public');
                    $image = new Image();
                    $image->path = '/storage/product/' . $fileName;
                    $image->imageable_id = $product->id;
                    $image->imageable_type = Product::class;
                    $image->save();
                }
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Thêm thất bại' . $exception->getMessage());
        }
        return redirect()->route('admin.product.list')->with('success', 'Thêm thành công');
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    public function doEdit(Request $request)
    {
        // TODO: Implement doEdit() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $url = asset('images/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
