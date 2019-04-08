<div class="col-lg-8 col-md-8 col-sm-12">

    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}</p>
    @endif

    <div class="card">
        <ul class="nav nav-tabs nav-tabs-card">
            <li class="nav-item">
                <a class="nav-link active" href="#first" data-toggle="tab">Job Role</a>
            </li>
        </ul>
        <div class="tab-content card-body">
            <div class="tab-pane active" id="first">
                <form action="{{ isset($job_role) ? route('jobrole.update', ['id' => $job_role->id]) : route('jobrole.insert') }}"
                    class="form-horizontal" method="POST">
                    {{ csrf_field() }}
                    @if(isset($job_role))
                    <input type="hidden" name="_method" value="PUT">
                    @endif

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label form-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" id="name" class="form-control" name="name"
                            placeholder="Name" value="{{ old('name') ? old('name') : isset($job_role) ? $job_role->name : ''}}">
                            @if ($errors->has('name'))
                                <small class="form-text text-warning">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-sm-3 col-form-label form-label">Description</label>
                        <div class="col-sm-8">
                            <input type="text" id="description" class="form-control" name="description"
                            placeholder="description" value="{{ old('description') ? description('name') : isset($job_role) ? $job_role->description : ''}}">
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
