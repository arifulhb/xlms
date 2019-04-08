<div class="tab-pane" id="change_role">
    <form action="{{ route('users.field.update', ['id'=> $user->id]) }}" class="form-horizontal" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="field" value="role"/>
        <div class="form-group row">
            <label for="role" class="col-sm-3 col-form-label form-label">Role</label>
            <div class="col-sm-6 col-md-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="material-icons md-18 text-muted">check_box</i>
                        </div>
                    </div>
                    @php
                        $user_roles = [];

                        foreach($user->roles as $role)
                        {
                            array_push($user_roles, $role->name);
                        }
                    @endphp
                    <select class="form-control" id="role" name="role">
                        <option disabled>Select a Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name}}" {{ in_array($role->name, $user_roles) ? 'selected' : ''}} >{{ $role->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 col-md-4 offset-sm-3">
                <button type="submit" class="btn btn-success"> Change Role</button>
            </div>
        </div>
    </form>
</div>
