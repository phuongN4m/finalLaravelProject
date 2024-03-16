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
        $data = User::find($id);
        return view('be.user.edit')->with([
            'data' => $data,
            'id' => $id
        ]);
    }
    public function doEdit(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            // dd($data);
            $user = User::find($data['id']);
            // dd($user);
            $file = $request->file('img');
            unset($data['_token']);
            unset($data['img']);

            $data['password'] = Hash::make($data['password']);

            User::where('id', $data['id'])->update($data);
            if (empty($file)) {
                $image['path'] = $user->image->path;
            } else {
                $idImage  = $user->image->id;
                $fileName = time() . $file->getClientOriginalName();
                $file->storeAs('/user', $fileName, 'public');
                $image = new Image();
                $image['imageable_id']   = $user->id;
                $image['imageable_type'] = User::class;
                $image['path']           = '/storage/user/' . $fileName;
                Image::where('id', $idImage)->delete();
                $image->save();
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', "Sửa thất bại" . $exception->getMessage());
        }
        return redirect()->route('admin.user.list')->with('success', "Sửa thành công");
    }
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $imageId  = $user->image;
        try {
            $user->delete();
            Image::where('id', $imageId)->delete();
        } catch (Exception $e) {
            return "Xoa that bai..." . $e->getMessage();
        }
    }
}
