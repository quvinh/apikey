<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function login(Request $request)
    {
        $pattern = [
            'name' => 'required|min:3|max:50',
            'password' => 'required|min:6|max:100',
        ];

        $messenger = [
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được nhỏ hơn :min ký tự',
            'max' => ':attribute không được lớn hơn :max ký tự',
        ];

        $customName = [
            'name' => 'Tên đăng nhập',
            'password' => 'Mật khẩu',
        ];

        $validator = Validator::make($request->all(), $pattern, $messenger, $customName);

        if ($request->getMethod() == 'GET') {
            return view('admin.login');
        }

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $credentials = $request->only(['name', 'password']);
        if (Auth::guard()->attempt($credentials)) {
            return redirect()->route('admin.list');
        } else {
            // return redirect()->back()->withInput();
            return redirect()->back()->withErrors(['msg' => 'Tên đăng nhập/Mật khẩu không đúng']);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

    public function list() {
        return view('list');
    }

    public function showList() {
        $data = Key::orderBy('remain', 'DESC')->get();
        return response()->json([
            'data' => $data,
        ]);
    }

    public function getKey() {
        $data = Key::orderBy('remain', 'DESC')->first();
        $url = Http::timeout(2)->get('https://pdftables.com/api/remaining?key='.$data->key)->json();
        $data->update([
            'remain' => $url
        ]);
        return response()->json([
            'data' => $data
        ]);
    }

    public function addKey(Request $request) {
        $validator = Validator::make($request->all(), [
            'key' => 'required|unique:keys',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 'warning',
                'message' => $validator
            ]);
        }
        // $url = 'https://pdftables.com/api/remaining?key='.$request->key;
        $url = Http::timeout(2)->get('https://pdftables.com/api/remaining?key='.$request->key)->json();
        if(is_numeric($url)) {
            Key::create(array_merge(
                $validator->validated(),
                [
                    'remain' => $url
                ]
            ));
            
            return response()->json([
                'status' => 'success',
                'message' => 'Key added successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'message' => 'Invalid Key'
            ]);
        }
    }

    public function deleteKey($id) {
        Key::find($id)->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Key deleted successfully'
        ]);
    }

    public function refreshKey() {
        DB::table('keys')->where('remain', 0)->delete();
        $key = Key::all()->take(5);
        foreach($key as $item) {
            $url = Http::timeout(2)->get('https://pdftables.com/api/remaining?key='.$item->key)->json();
            Key::where('id', $item->id)->update([
                'remain' => $url
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Key freshed'
        ]);
    }
}
