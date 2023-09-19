@extends('layouts.app')

@section('title', 'Logo & Footer')
@section('content')
    <!-- Row -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('setting.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Logo</label>
                                <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                                    <input type="file" name="logo" class="dropify" data-bs-height="180">
                                    @error('logo')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Footer Logo</label>
                                <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                                    <input type="file" name="footer_logo" class="dropify" data-bs-height="180">
                                    @error('footer_logo')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Favicon</label>
                                <div class="col-lg-12 col-sm-12 mb-4 mb-lg-0">
                                    <input type="file" name="favicon_icon" class="dropify" data-bs-height="180">
                                    @error('favicon_icon')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-5   ">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('setting.updateSocialMediaLink') }}" method="POST">
                        @csrf
                        <div class="row">
                            <label class="form-label fw-bold mb-4">Social Media Links</label>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa fa-facebook" aria-hidden="true"></i>
                                                            </span>
                                        <input type="text" class="form-control" name="facebook_link" placeholder="Facebook Link" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa fa-instagram" aria-hidden="true"></i>
                                                            </span>
                                        <input type="text" class="form-control" name="instagram_link" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                                            </span>
                                        <input type="text" class="form-control" name="youtube_link" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <i class="fa fa-linkedin" aria-hidden="true"></i>
                                                            </span>
                                        <input type="text" class="form-control" name="linkedin_link" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection
@push('js')
    <!-- FILE UPLOADES JS -->
    <script src="{{ asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>

    <!-- INTERNAL File-Uploads Js-->
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
@endpush
