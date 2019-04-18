@component('parts.components.modal',
['modal_id' => 'modal_add_lesson', 'modal_title' => 'Add new Lesson'])

    <p>This is a add form</p>

    @slot('apply')
        <button type="button" class="btn btn-primary btn-add-lesson"><i class="material-icons">add_circle</i>&nbsp;Add</button>
    @endslot
@endcomponent
