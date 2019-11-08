
<div class="col-lg-12 col-sm-12 col-md-12">
    <form method="post" action="{{ route('course.insert') }}" enctype="multipart/form-data">
    <div class="row">

            {{ csrf_field() }}
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

                    @component('parts.components.form-group', ['name' => 'introduction', 'column' => 'col-sm-12 col-md-12'])
                        <small class="text-mutted">Course description and overview</small>
                        <textarea  class="form-control" id="post_introduction" rows="8" placeholder="body"
                        name="introduction">{{ old('introduction') ? old('introduction') : ''}}{{  isset($course) ? $course->introduction : '' }}</textarea>
                    @endcomponent

                    @component('parts.components.form-group', ['name' => 'outline', 'column' => 'col-sm-12 col-md-12'])
                        <small class="text-mutted">Course outline, course flowchart</small>
                        <textarea  class="form-control" id="post_outline" rows="8" placeholder="Outline"
                        name="outline">{{ old('outline') ? old('outline') : ''}}{{  isset($course) ? $course->structure : '' }}</textarea>
                    @endcomponent

                    @component('parts.components.form-group', ['name' => 'Key Takeaway', 'column' => 'col-sm-12 col-md-12'])
                        <small class="text-mutted">What student will learn. Bulletpoints only</small>
                        <textarea  class="form-control" id="post_key_takeaway" rows="8" placeholder="key takeaway"
                            name="keytakeaway">{{ old('keytakeaway') ? old('keytakeaway') : ''}}{{  isset($course) ? $course->key_takeaway : '' }}</textarea>
                    @endcomponent

                </div>
            </div>
        </div>

        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Operation</h4>
                </div>
                <div class="card-body">
                    <p class="text-right">
                        <button type="submit" class="btn btn-primary"><i class="material-icons">save</i>&nbsp;Save</button>
                    </p>
                    @isset($course)
                    <p>
                        @component('parts.components.form-group', ['name' => 'status', 'column' => 'col-sm-12 col-md-12'])
                        <select id="status" name="status" class="form-control">
                            @foreach(COURSE_STATUS as $id => $status)
                                <option value="{{ $id }}" {{ $course->status == $id ? 'SELECTED' : ''}}>{{ $status }}</option>
                            @endforeach
                        </select>
                        @endcomponent
                    </p>
                    @endisset
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thumbnail Image</h4>
                    {{-- <p class="card-subtitle">Extra Options </p> --}}
                </div>
                <div class="card-body">
                    {{-- @isset($course) --}}
                    <img src="{{ asset('storage/'.$course->thumbnail_small) }}" alt="img"
                    class=""/>
                    {{-- @endisset --}}
                    <input type="file" class="form-control" name="thumbnail"/>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Meta</h4>
                    <p class="card-subtitle">Extra Options </p>
                </div>

                <div class="card-body" action="#">
                    @component('parts.components.form-group', ['name' => 'author', 'column' => 'col-sm-12 col-md-12'])
                        <select id="author" name="author" class="form-control">
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" {{ isset($course) ? $course->author->id == $author->id ? 'SELECTED' : '' : ''}}>{{ $author->name }}</option>
                            @endforeach
                        </select>
                    @endcomponent

                    @component('parts.components.form-group', ['name' => 'categories', 'column' => 'col-sm-12 col-md-12'])

                    @php
                        $categoryIds = [];
                        if (isset($course)){
                            $categoryIds = $course->categories->pluck('id')->toArray();
                        }
                    @endphp
                        <select id="categories" name="categories" class="form-control">
                            @foreach($categories as $head)
                                <optgroup label="{{ $head['name']}}">
                                    @foreach($head['child'] as $child)
                                        <option value="{{ $child['id'] }}" {{ in_array($child['id'], $categoryIds) ? 'SELECTED' : '' }}>{{ $child['name'] }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    @endcomponent

                    @component('parts.components.form-group', ['name' => 'difficulty', 'column' => 'col-sm-12 col-md-12'])

                        <select id="difficulty" name="difficulty" class="form-control">
                        @foreach(COURSE_DIFFICULTY_LEVELS as $id=> $difficulty)
                            <option value="{{$id}}" {{ isset($course) ? $course->difficulty_level == $id ? 'SELECTED' : '' : ''}} >{{$difficulty}}</option>
                        @endforeach
                        </select>

                    @endcomponent

                    @component('parts.components.form-group', ['name' => 'duration', 'column' => 'col-sm-12 col-md-12'])
                        <input id="duration" type="text" class="form-control" name="duration"
                        placeholder="e.g. 5 hours, 30min" value="{{ old('duration') ? old('duration') : ''}}{{  isset($course) ? $course->hours : '' }}">
                    @endcomponent

                </div>
            </div>
        </div>

    </div>
    </form>

    @isset($course)
        @include('admin.course.crud.modules')
    @else
    <div class="alert alert-warning">
        <i class="material-icons">info_outline</i> <strong>Course Module Management</strong> section will appear after initial save of the course .
    </div>
    @endisset


</div>

@isset($course)
    @push('footer-html')
        @include('admin.course.crud._partials.add_module_modal')
    @endpush
@endisset

