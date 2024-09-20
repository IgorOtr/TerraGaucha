<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>

<script>
  function previewImage() {
      const input = document.getElementById('imageUpload');
      const preview = document.getElementById('imagePreview');

      if (input.files && input.files[0]) {
          const reader = new FileReader();

          reader.onload = (e) => {
          preview.src = e.target.result;
          };

          reader.readAsDataURL(input.files[0]);
      }
  }
</script>

<script>
    $('#summernote').summernote({
      placeholder: 'Comece a escrever aqui...',
      tabsize: 2,
      height: 400,
      foreColor: '#000000',
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link', 'picture']],
        ['view', ['codeview']]
      ]
    });
  </script>
</body>
</html>
