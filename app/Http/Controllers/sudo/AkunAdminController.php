<?php

namespace App\Http\Controllers\sudo;

use App\Http\Controllers\Controller;
use App\Models\Administrasi;
use App\Models\AdminLab;
use App\Models\HistoryPangkatAdmin;
use App\Models\User;
use Illuminate\Http\Request;

class AkunAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'admins' => Administrasi::all()
        ];
        return view('akun.admin.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('akun.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validation = $request->validate([
            'nama' => 'required|string|min:3',
            'email' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]);
        if ($validation) {
            $account = new User();
            $account->name = $request->nama;
            $account->email = $request->email;
            $account->email_verified_at = now();
            $account->profile_picture = 'default.png';
            $account->password = bcrypt($request->password);
            $account->assignRole($request->role);
            $account->save();

            return redirect()->route('sudo.akun_admin.index')->with('success', 'Akun Admin berhasil ditambahkan');
        } else {
            return redirect()->route('sudo.akun_admin.index')->with('error', 'Akun Admin gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $admin = Administrasi::find($id);
        $data = [
            'admin' => $admin,
            'account' => User::find($admin->user_id),
            'pangkat' => HistoryPangkatAdmin::where('administrasi_id', $id)->orderBy('tgl_sk', 'desc')->get()
        ];
        return view('akun.admin.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $admin = Administrasi::find($id);
        $data = [
            'admin' => $admin,
            'account' => User::find($admin->user_id)
        ];
        return view('akun.admin.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $admin = Administrasi::find($id);
        $account = User::find($admin->user_id);
        $account->email = $request->email;
        if ($request->password != null) {
            $account->password = bcrypt($request->password);
        }
        $admin->status = $request->status;
        $account->syncRoles($request->role);
        $admin->save();
        $account->save();
        return redirect()->route('sudo.akun_admin.index')->with('success', 'Akun Admin berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $admin = Administrasi::find($id);
        $id_user = $admin->user_id;
        $user = User::find($id_user);
        $admin->delete();
        $user->delete();
        return redirect()->route('sudo.akun_admin.index');
    }
}
