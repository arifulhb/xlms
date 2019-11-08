<div class="col-lg-8 col-md-8 col-sm-12">

    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
    @endif

    <div class="card">
        <ul class="nav nav-tabs nav-tabs-card">
            <li class="nav-item">
                <a class="nav-link active" href="#first" data-toggle="tab">Coruse Category</a>
            </li>
        </ul>
        <div class="tab-content card-body">
            <div class="tab-pane active" id="first">
                <form action="{{ isset($course_category) ? route('course_category.update', ['id' => $course_category->id]) : route('course_category.insert') }}"
                    class="form-horizontal" method="POST">
                    {{ csrf_field() }}
                    @if(isset($course_category))
                    <input type="hidden" name="_method" value="PUT">
                    @endif

                    @isset($root_categories)
                        @component('parts.components.form-group',
                            ['name' => 'parent_id', 'icon_name' => 'folder', 'column' => 'col-sm-6 col-md-6'])
                            <select name="parent_id" class="form-control">
                                <option selected>Root Category</option>
                                @foreach($root_categories as $root)
                                    <option value="{{ $root->id }}" {{ isset($course_category) ? $root->id == $course_category->parent_id ? 'selected' : '' : ''}}
                                        >{{ $root->name }}</option>
                                @endforeach
                            </select>
                        @endcomponent
                    @endisset

                    @component('parts.components.form-group',
                        ['name' => 'name', 'icon_name' => 'info_outline', 'column' => 'col-sm-6 col-md-6'])
                        <input type="text" id="name" class="form-control" name="name"
                            placeholder="Name" value="{{  old('name') ? old('name') : '' }}{{ isset($course_category) ? $course_category->name : '' }}">
                    @endcomponent


                    @component('parts.components.form-group',
                        ['name' => 'slug', 'icon_name' => 'insert_link', 'column' => 'col-sm-6 col-md-6'])
                        <input type="text" id="slug" class="form-control" name="slug"
                            placeholder="slug" value="{{  old('slug') ? old('slug') : '' }}{{ isset($course_category) ? $course_category->slug : '' }}">
                    @endcomponent

                    @component('parts.components.form-group',
                        ['name' => 'description', 'column' => 'col-sm-12 col-md-8 col-lg-8'])
                        <input type="text" id="description" class="form-control" name="description"
                            placeholder="Description" value="{{  old('description') ? old('description') : '' }}{{ isset($course_category) ? $course_category->description : '' }}">
                    @endcomponent

                    <div class="form-group row">
                        <div class="col-sm-8 offset-sm-3">
                            <div class="media align-items-center">
                                <div class="media-left">
                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
