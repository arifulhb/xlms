<div class="form-group row">
    <label for="{{$name}}" class="col-sm-12 col-lg-6 col-md-6 col-form-label form-label">{{ ucfirst(str_replace('_', ' ', $name)) }}</label>
    <div class="{{ isset($column) ? $column : 'col-sm-6 col-md-6' }}">
        <div class="input-group  {{ $errors->has($name) ? 'invalid-feedback'  : '' }}">
            @isset($icon_name)
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="material-icons md-18 text-muted">{{ $icon_name}}</i>
                </div>
            </div>
            @endisset
            {{ $slot }}
        </div>
        @if ($errors->has($name))
            <small class="form-text text-warning">{{ $errors->first($name) }}</small>
        @endif
    </div>
</div>
