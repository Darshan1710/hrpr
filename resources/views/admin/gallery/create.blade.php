@extends('layouts.backend.master')

@section('title')
    Gallery - Create
@endsection

@push('styles')
    @include('admin.injector.admin-attriutes-injector')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/dropzone-custom.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/admin/dropzone.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $(".submit-form").click(function(){
                $("#upload-zone").submit()
            });

            $(window).on('load', function(){
                Dropzone.autoDiscover = false;
            })
            var uploadedDocumentMap = {};

            var dropzoneOptions = {
                dictDefaultMessage: 'Drag & drop here or click to select',
                paramName: "document",
                url: '{{ route('admin.gallery.upload') }}',
                maxFilesize: 2, // MB
                addRemoveLinks: true,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (file, response) {
                    if(response.success){
                        $('form').append('<input type="hidden" name="document[' + file.name + ']" value="' + response.image_path + '">')
                        uploadedDocumentMap[file.name] = response.image_path
                    } else {
                        $('form').find('input[name="document[' + file.name + ']"][value="' + name + '"]').remove()
                        file.previewElement.remove()
                        alert(response.message);
                    }
                },
                removedfile: function (file) {
                    console.log(file)
                    file.previewElement.remove()

                    if(uploadedDocumentMap[file.name] != null){
                        let path = uploadedDocumentMap[file.name];
                        $('form').find('input[name="document[' + file.name + ']"][value="' + path + '"]').remove()
                    }
                },
                // init: function () {
                //     @if(isset($project) && $project->document)
                //         var files = {!! json_encode($project->document) !!}
                //         for (var i in files) {
                //             var file = files[i]
                //             this.options.addedfile.call(this, file)
                //             file.previewElement.classList.add('dz-complete')
                //             $('form').append('<input type="hidden" name="document['file.file_name']" value="' + file.file_path + '">')
                //         }
                //     @endif
                // }
            };
            var uploader = document.querySelector('#upload-zone');
            var myDropzone = new Dropzone(uploader, dropzoneOptions);
        })
</script>

@endpush

@section('page-content')
    <div class="main-container container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                @include('layouts.backend.messages')

                <label for="document">Gallery</label>

                <form id="upload-zone" class="upload-zone form-horizontal" method="POST" enctype="multipart/form-data" action="{{ route('admin.gallery.store') }}">
                    @csrf

                    <!--category-->
                    <div class="form-group mb-0">      
                        <label class="col-form-label" for="album">Album</label>
                        <div class="col-md-4">
                            <select class="form-control" name="album" id="album" required="required">
                                <option value="">Select Category</option>
                                @foreach ($albumList as $album)
                                <option value="{{ $album->id }}" {{ old('album') == $album->id ? 'selected' : '' }}>
                                    {{ $album->album }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--/category-->
                    
                    <div class="fallback">
                        <input name="document" id="document-dropzone" type="file" multiple />
                    </div>
                </form>
                <div class="form-group d-flex justify-content-end mt-3">
                    <input class="btn btn-danger submit-form" type="submit">
                </div>

            </div>
        </div>
    </div>
@endsection
