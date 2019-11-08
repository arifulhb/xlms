<div class="card">
    <div class="card-header" id="headingTwo">
        <h5 class="m-0 p-0">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Collapsible Group Item #2
                    </button>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6 text-right pt-1">
                    <button class="btn btn-sm btn-info">New Lesson&nbsp;<i style="margin-top:2px;" class="material-icons">add_circle</i></button>
                </div>
            </div>
        </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
            <p>
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
            </p>
            <div class="nestable" id="nestable-handles-primary">
                <ul class="nestable-list mb-0">
                    @include('admin.course.crud._partials.lesson')
                    @include('admin.course.crud._partials.lesson')
                    @include('admin.course.crud._partials.lesson')
                </ul>
            </div>

        </div>
    </div>
</div>
