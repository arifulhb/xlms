
<div class="col-lg-12 col-sm-12 col-md-12">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Basic Information</h4>
                </div>
                <div class="card-body">

                    @component('parts.components.form-group',
                        ['name' => 'title', 'column' => 'col-sm-12 col-md-12'])
                        <input id="title" type="text" class="form-control" name="title"
                        placeholder="Course Title" value="{{ old('title') ? old('title') : ''}}{{  isset($course) ? $course->name : '' }}">
                    @endcomponent

                    @component('parts.components.form-group',
                        ['name' => 'tagline', 'column' => 'col-sm-12 col-md-12'])
                            <input id="tagline" type="text" class="form-control" name="tagline"
                        placeholder="Course Tagline" value="{{ old('tagline') ? old('tagline') : ''}}{{  isset($course) ? $course->brief : '' }}">
                    @endcomponent

                    {{-- @component('parts.components.form-group',
                        ['name' => 'slug', 'column' => 'col-sm-12 col-md-12'])
                            <input id="slug" type="text" class="form-control" name="slug"
                        placeholder="Course slug" value="{{ old('slug') ? old('slug') : ''}}{{  isset($course) ? $course->slug : '' }}">
                    @endcomponent --}}

                    <div class="form-group mb-0">
                        <label class="form-label">Introduction <small class="text-mutted">Course description and overview</small></label>
                        <div style="height: 150px;" data-toggle="quill" data-quill-placeholder="Course description and overview"
                        data-quill-modules-toolbar='[[{"header": [2, 3, 4, false]}], ["bold", "italic", "underline", "strike"], ["link", "blockquote", "code"], [{ "indent": "-1"}, { "indent": "+1" }], [{"list": "ordered"}, {"list": "bullet"}]]'>
                            <p></p>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label class="form-label">Outline <small class="text-mutted">Course outline, course flowchart</small></label>
                        <div style="height: 150px;" data-toggle="quill" data-quill-placeholder="Quill WYSIWYG editor"
                        data-quill-modules-toolbar='[[{"header": [2, 3, 4, false]}],["bold", "italic", "underline", "strike"], ["link", "blockquote", "code"], [{ "indent": "-1"}, { "indent": "+1" }], [{"list": "ordered"}, {"list": "bullet"}]]'>
                            <p></p>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label class="form-label">Key Takeaway <small class="text-mutted">What student will learn. Bulletpoints only</small></label>
                        <div style="height: 150px;" data-toggle="quill" data-quill-placeholder="Key Takeaway skills and knowledge"
                            data-quill-modules-toolbar='[["bold", "italic", "underline", "strike"], [{"list": "ordered"}, {"list": "bullet"}]]'>
                            <p></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thumbnail Image</h4>
                    {{-- <p class="card-subtitle">Extra Options </p> --}}
                </div>
                <div class="card-body">
                    <img src="" alt=""
                    class=""/>
                    <input type="file" class="form-control" />
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Meta</h4>
                    <p class="card-subtitle">Extra Options </p>
                </div>

                <form class="card-body" action="#">
                    @component('parts.components.form-group', ['name' => 'categories', 'column' => 'col-sm-12 col-md-12'])
                        <select id="categories" name="categories" class="form-control">
                            @foreach($categories as $head)
                                <optgroup label="{{ $head['name']}}">
                                    @foreach($head['child'] as $child)
                                        <option value="{{ $child['id'] }}">{{ $child['name'] }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    @endcomponent

                    @component('parts.components.form-group', ['name' => 'difficulty', 'column' => 'col-sm-12 col-md-12'])

                        <select id="difficulty" name="difficulty" class="form-control">
                        @foreach(COURSE_DIFFICULTY_LEVELS as $id=> $difficulty)
                            <option value="{{ $id}}">{{$difficulty}}</option>
                        @endforeach
                        </select>

                    @endcomponent


                    @component('parts.components.form-group', ['name' => 'duration', 'column' => 'col-sm-12 col-md-12'])
                        <input id="duration" type="text" class="form-control"
                            placeholder="e.g. 5 hours, 30min" value="">
                    @endcomponent


                    {{-- <div class="form-group mb-0">
                        <label class="form-label" for="option1">Completion Badge</label>
                        <div>
                            <div data-toggle="buttons">
                                <label class="btn btn-primary btn-circle active">
                                    <input type="radio" class="d-none" name="options" id="option1" checked>
                                    <i class="material-icons">person</i>
                                </label>
                                <label class="btn btn-danger btn-circle">
                                    <input type="radio" class="d-none" name="options" id="option2">
                                    <i class="material-icons">star</i>
                                </label>
                                <label class="btn btn-success btn-circle">
                                    <input type="radio" class="d-none" name="options" id="option3">
                                    <i class="material-icons">shop</i>
                                </label>
                                <label class="btn btn-warning btn-circle">
                                    <input type="radio" class="d-none" name="options" id="option4">
                                    <i class="material-icons">monetization_on</i>
                                </label>
                                <label class="btn btn-info btn-circle">
                                    <input type="radio" class="d-none" name="options" id="option5">
                                    <i class="material-icons">enhanced_encryption</i>
                                </label>
                            </div>
                        </div>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>

    @include('admin.course.crud.modules')


</div>

@push('footer-html')
@include('admin.course.crud._partials.add_module_modal')
@endpush

