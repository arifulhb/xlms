@component('parts.components.modal',
['modal_id' => 'modal_add_module', 'modal_title' => 'Add new Module'])

    <p>This is a add form</p>

    @slot('apply')
        <button type="button" class="btn btn-primary btn-add-module"><i class="material-icons">add_circle</i>&nbsp;Add</button>
    @endslot
@endcomponent
