<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->hasRole(['mahasiswa','mahasiswaS2'])){
            if($request->user()->mahasiswa->tanggal_masuk == null){
                return redirect()->route('mahasiswa.profile.create');
            }
        }else if($request->user()->hasRole('dosen')){
            if($request->user()->dosen == null){
                return redirect()->route('dosen.profile.create');
            }
        }else if($request->user()->hasRole('admin lab') || $request->user()->hasRole('admin berkas')){
            if($request->user()->administrasi == null){
                return redirect()->route('admin.profile.create');
            }
        }
        return $next($request);
    }
}
