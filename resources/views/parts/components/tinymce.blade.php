@section('footer_js')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script>
    var editor_config = {
        path_absolute : "/",
        selector: "{{ $element }}",
        menubar: false,
        plugins: [
            "advlist autolink lists link charmap print preview hr anchor",
            "searchreplace wordcount visualblocks visualchars code",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        relative_urls: false,

    };
    tinymce.init(editor_config);
</script>
