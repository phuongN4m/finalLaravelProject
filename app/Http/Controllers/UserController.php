<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller implements iCRUD
{
    //
    public function list()
    {
        $list = User::all();
        return view('be.user.list')->with(['list' => $list]);
    }

    public function add()
    {
        return view('be.user.add');
    }

    public function doAdd(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            // dd($data);

            $img = $data['img'];
            unset($data['_token']);
            unset($data['img']);
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            $fileName = time() . $img->getClientOriginalName();
            $img->storeAs('/user', $fileName, 'public');
            // dd($fileName);
            $image = new Image();
            $image->path = '/storage/user/' . $fileName;
            $image->imageable_id = $user->id;
            $image->imageable_type = User::class;
            $image->save();
            DB::commit();
            return redirect()->route('admin.user.list')->with([
                'message' => 'Them thanh cong'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.user.list')->with([
                'error' => 'Them that bai ' . $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('be.user.edit')->with([
            'data' => $user,
            'id' => $id
        ]);
    }

    public function doEdit(Request $request)
    {

        try {
            DB::beginTransaction();
            // get input
            $data = $request->all();
            $fileImage = $request->file('img');
            $user = User::find($data['id']);

            // update img
            // get the old img
            $image = $user->images;

            // if user want to change avatar
            if (!empty($fileImage)) {
                // get the input img
                $inputImage = $data['img'];
                // change the image name
                $imageName = time() . $fileImage->getClientOriginalName();
                // save to /public/user/
                $inputImage->storeAs('/user', $imageName, 'public');
                // update the path
                $image->path = '/storage/user/' . $imageName;
                // update img info
                $image->imageable_id = $user->id;
                $image->imageable_type = User::class;
                try {
                    $image->save();
                } catch (\Exception $e) {
                    return ('Failed to save, ' . $e->getMessage());
                }

            } else {
                // keep the old path
                $image['path'] = $user->images->path;
            }
            unset($data['_token']);
            unset($data['img']);
            $data['password'] = Hash::make($data['password']);
            User::where('id', '=', $data['id'])->update($data);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', "Sửa thất bại, " . $exception->getMessage());
        }
        return redirect()->route('admin.user.list')->with('success', "Sửa thành công");
    }

    public function delete(Request $request)
    {
//        dd($request->id);
        $user = User::find($request->id);
//        dd(User::find($request->id));
        $imageId = $user->images->id;
        try {
            $user->delete();
            Image::where('id', $imageId)->delete();
        } catch (Exception $e) {
            return "Xoa that bai..." . $e->getMessage();
        }

        return redirect()->route('admin.user.list')->with('success', "Xóa thành công");
    }
}
