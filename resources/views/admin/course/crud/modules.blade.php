<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <h5 class="card-title pull-left">Modules and Lessons</h5>
                    </div>
                    <div class="col-lg-6 col-sm-6 text-right">
                        {{-- <a href="instructor-lesson-add.html"
                            data-trigger="modal"
                            modal_add_module
                            class="btn btn-sm btn-primary">Add Module&nbsp;<i class="material-icons">add_circle_outline</i>
                        </a> --}}
                        <button class="btn btn-sm btn-primary"
                            data-title="Add Module" data-toggle="modal"
                            data-target="#modal_add_module">
                            Add Module&nbsp;<i class="material-icons">add_circle_outline</i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body" style="background-color:#fafafa">
                <div class="accordion" id="accordionExample">
                    @include('admin.course.crud._partials.module')
                </div>

            </div>
        </div>
    </div>
</div>
