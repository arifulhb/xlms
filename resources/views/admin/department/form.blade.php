<div class="col-lg-8 col-md-8 col-sm-12">

    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
    @endif

    <div class="card">
        <ul class="nav nav-tabs nav-tabs-card">
            <li class="nav-item">
                <a class="nav-link active" href="#first" data-toggle="tab">Department</a>
            </li>
        </ul>
        <div class="tab-content card-body">
            <div class="tab-pane active" id="first">
                <form action="{{ isset($department) ? route('dept.update', ['id' => $department->id]) : route('dept.insert') }}"
                    class="form-horizontal" method="POST">
                    {{ csrf_field() }}
                    @if(isset($department))
                    <input type="hidden" name="_method" value="PUT">
                    @endif

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label form-label">Name</label>
                        <div class="col-sm-8">
                            {{-- <div class="input-group {{ $errors->has('name') ? 'invalid-feedback'  : '' }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="material-icons md-18 text-muted">person</i>
                                    </div>
                                </div>

                            </div> --}}
                            <input type="text" id="name" class="form-control" name="name"
                            placeholder="Name" value="{{ old('name') ? old('name') : isset($department) ? $department->name : ''}}">
                            @if ($errors->has('name'))
                                <small class="form-text text-warning">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-sm-3 col-form-label form-label">Description</label>
                        <div class="col-sm-8">
                            <input type="text" id="description" class="form-control" name="description"
                            placeholder="description" value="{{ old('description') ? description('name') : isset($department) ? $department->description : ''}}">
                            @if ($errors->has('description'))
                                <small class="form-text text-warning">{{ $errors->first('description') }}</small>
                            @endif
                        </div>
                    </div>

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
