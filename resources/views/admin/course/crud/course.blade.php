
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

                    <div class="form-group mb-4">
                        <label class="form-label">Introduction <small class="text-mutted">Course description and overview</small></label>
                        <textarea  class="form-control" id="post_introduction" rows="8" placeholder="body"  name="body"></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Outline <small class="text-mutted">Course outline, course flowchart</small></label>
                        <textarea  class="form-control" id="post_outline" rows="8" placeholder="Outline"  name="outline"></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Key Takeaway <small class="text-mutted">What student will learn. Bulletpoints only</small></label>
                        <textarea  class="form-control" id="post_key_takeaway" rows="8" placeholder="key takeaway"  name="keytakeaway"></textarea>
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

                <div class="card-body" action="#">
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

                </div>
            </div>
        </div>

    </div>

    @isset($course)
        @include('admin.course.crud.modules')
    @endisset


</div>

@isset($course)
    @push('footer-html')
        @include('admin.course.crud._partials.add_module_modal')
    @endpush
@endisset

