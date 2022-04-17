<script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: {
                shouldNotGroupWhenFull: true
            }
        })
        .then(newEditor => {
            newEditor.model.document.on('change:data', () => {
                window.editor.textContent = `"${newEditor.getData()}"`;
            });

        })
        .catch(error => {
            console.error(error);
        });
</script>