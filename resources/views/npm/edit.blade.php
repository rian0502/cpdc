@extends('layouts.admin')
@section('admin')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">

                <!-- Default Basic Forms Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix">
                        <div class="pull-left">
                            <h4 class="text-dark h4">Edit NPM</h4>
                        </div>
                </div>
                <form action="{{ route('sudo.base_npm.update', $student->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="profile-edit-list row">
                        {{-- form untuk sebelah kiri --}}
                        <div class="weight-500 col-md-6">
                            <div class="form-group">
                                <label>npm</label>
                                <input autofocus name="npm" id="npm" value="{{ $item->npm }} "
                                    class="form-control @error('npm') form-control-danger @enderror" type="text"
                                    placeholder="npm">
                                @error('npm')
                                <div class="form-control-feedback has-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                            {{-- form untuk sebelah kanan --}}

                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit btn btn-primary">Submit</button>
                        </div>

                    </form>
                    <a href="{{ route('sudo.base_npm.index') }}">

                        <button class="batal btn btn-secondary">Batal</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- Input Validation End -->


    </div>
@endsection
