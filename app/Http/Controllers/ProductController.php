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
//        dd($request->all());
        try {
            DB::beginTransaction();
            $data = $request->all();
//            dd($data);
            $files = $data['img'];
//            dd($files);
            unset($data['_token']);
//            dd($data);
            unset($data['img']);
//            dd($data);
            $product = (new \App\Models\Product)->create($data);
//            dd($product);
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
        $product = Product::find($id);
        $categories = Category::all();
        $sales = Sale::all();
        return view('be.product.edit')->with([
            'id' => $id,
            'product' => $product,
            'categories' => $categories,
            'sales' => $sales
        ]);
    }

    public function doEdit(Request $request)
    {
        // TODO: Implement doEdit() method.
        try {
            DB::beginTransaction();
            // get the update info
            $updateInfo = $request->all();
//            dd($updateInfo);
            // get the target product
            $product = Product::find($request->id);
            // get the old imgs
//            $images = $product->images;
//            dd($images);

//            // get the update imgs
//            $updateImages = $request->file('img');
//            dd($updateImages);

            unset($updateInfo['_token']);
//            unset($updateInfo['img']);
////            dd($updateInfo);
//
////            dd($product);
//
//            // update imgs
//            if (!empty($updateImages)) {
//
//            }


            // update product info
            $product->update($updateInfo);
//            dd($product);
            DB::commit();

            $list = Product::all();
            return view('be.product.list')->with('list', $list);

        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Sua that bai' . $exception->getMessage());
        }
    }

    public function delete(Request $request)
    {
        // TODO: Implement delete() method.
        $product = Product::find($request->id);
        try {
            DB::beginTransaction();
            $product->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Đã xóa sản phẩm');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Chưa xóa được sản phẩm');
        }
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
