<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\SendEmailResetRequest;
use App\Http\Requests\UpdateResetPasswordRequest;
use App\Models\BaseNPM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login()
    {

        return view('auth.login');
    }

    public function loginAttempt(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'status' => 'Email dan Password tidak cocok.',
        ]);
    }
    //melakukan logout pada user
    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
    //melakukan pengiriman link reset password
    public function sendResetLinkEmail(SendEmailResetRequest $request)
    {
        $credentials = $request->only('email');
        $status = Password::sendResetLink($credentials);
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Link reset password telah terkirim');
        }
        return back()->with([
            'error' => 'Link reset password gagal dikirim',
        ]);
    }
    //menampilkan halaman reset password
    public function showResetPasswordForm($token)
    {

        return view('auth.reset', ['token' => $token]);
    }
    //melakukan reset password
    public function resetPassword(UpdateResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
            }
        );
        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('auth.login')->with('status', __($status));
        }
        return back()->withErrors([
            'email' => __($status),
        ]);
    }

    public function forgotPassword()
    {
        return view('auth.forgot');
    }

    public function register()
    {
        $data = [
            'dosen' => Dosen::where('status', 'Aktif')->get(),
        ];
        return view('auth.register', $data);
    }
    public function attemptRegister(RegisterRequest $request)
    {
        $user = User::create([
            'name' => Str::title($request->nama_lengkap),
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $aktifkan = BaseNPM::where('npm', $request->npm)->first();
        $aktifkan->status = 'aktif';
        $aktifkan->save();
        $mhs = [
            'npm' => $request->npm,
            'nama_mahasiswa' => Str::title($request->nama_lengkap),
            'angkatan' => $request->angkatan,
            'jenis_kelamin' => $request->gender,
            'user_id' => $user->id,
        ];
        if ($request->id_dosen != null) {
            $mhs['id_dosen'] = Crypt::decrypt($request->id_dosen);
        }
        if ($request->jenis_akun == 'mahasiswa') {
            $user->assignRole('mahasiswa');
            $mhs['status'] = 'Aktif';
        } else {
            $user->assignRole('alumni');
            $mhs['status'] = 'Alumni';
        }
        $mahasiswa = Mahasiswa::create($mhs);
        event(new Registered($user));
        $user->sendEmailVerificationNotification();
        auth()->login($user);
        return redirect()->route('verification.notice')->with(
            'registered',
            'Pendaftaran berhasil, silahkan cek email untuk melakukan verifikasi, Jika Vertifikasi tidak ada di kotak masuk, silahkan cek di kotak spam, atau klik tombol Kirim Kembali'
        );
    }

    public function reactivation()
    {
        return view('auth.activation');
    }
    public function settings()
    {
        return view('settings');
    }
    public function changePassword(Request $req)
    {
        //validasi token
        if ($req->_token != session()->token()) {
            return redirect()->back();
        } else {
            //check password old
            $user = User::find(Auth::user()->id);
            if (password_verify($req->current_password, $user->password)) {
                $validation = $req->validate([
                    'new_password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/',
                    'confirm_new_password' => 'required|same:new_password',
                ], [
                    'new_password.required' => 'Password baru harus diisi',
                    'new_password.min' => 'Password minimal 8 karakter',
                    'new_password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan karakter',
                    'confirm_new_password.required' => 'Konfirmasi password baru harus diisi',
                    'confirm_new_password.same' => 'Konfirmasi password baru tidak cocok',
                ]);
                if ($validation) {
                    $user->password = bcrypt($req->new_password);
                    $user->save();
                    return redirect()->route('dashboard')->with('success', 'Password berhasil diubah');
                }
            } else {
                return redirect()->back()->with('error', 'Password lama tidak cocok');
            }
        }
    }
}
