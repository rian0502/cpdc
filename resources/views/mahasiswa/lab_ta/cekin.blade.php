@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">PRESENSI LAB TUGAS AKHIR</h4>
                            <p class="mb-30">Isi data dengan benar</p>
                        </div>

                    </div>
                    <form action="{{ route('lab.ruang.store') }}" method="POST">
                        @csrf
                        <div class="profile-edit-list row">
                            {{-- form untuk sebelah kiri --}}
                            <div class="weight-500 col-md-6">
                                {{-- KONDISIIN INI MUNCUL KLK DIA BARU PERTAMA KALI CEKIN BAKAL MUNCUL FIELD PILIH LOKASI
                                    TRUS KLK MISAL HARI SEBELUMNYA UDAH PERNAH CEKIN MAKA PILIH LOKASINYA GA TAMPIL DAN BAKAL
                                    PAKE DATA LOKASI DI HARI SEBELUMNYA UNTUK SETERUSNYA ATAU KEK GIMANE TERSERAH LU DA --}}
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <select class="custom-select2 form-control" style="width: 100%; height: 38px"
                                        name="id_lokasi" required>
                                        {{-- @foreach ($locations as $item)
                                            <option value="{{ $item->encrypt_id }}"
                                                {{ old('id_lokasi') == $item->encrypt_id ? 'selected' : '' }}>
                                                {{ $item->nama_lokasi }}
                                            </option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea class="form-control textarea @error('ket') form-control-danger @enderror" name="ket">{{ old('ket') }}</textarea>
                                    @error('ket')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- form untuk sebelah kanan --}}
                            <div class="merek weight-500 col-md-6">
                                <div class="form-group">
                                    <label>Jam Mulai</label>
                                    <input
                                        class="form-control time-picker-default @error('jam_mulai') form-control-danger @enderror"
                                        placeholder="time" type="text" name="jam_mulai" value="{{ old('jam_mulai') }}" />
                                    @error('jam_mulai')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Jam Selesai</label>
                                    <input
                                        class="form-control time-picker-default @error('jam_selesai') form-control-danger @enderror"
                                        placeholder="time" type="text" name="jam_selesai"
                                        value="{{ old('jam_selesai') }}" />
                                </div>
                                <div class="d-flex">

                                    <div class="form-group">
                                        <button type="submit" class="submit btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
