<script>
  var editor_config = {
    path_absolute : "/",
    selector: "textarea.productDescription",
    plugins: [
      // "advlist autolink lists link  charmap  preview hr anchor pagebreak",
      // "searchreplace wordcount visualblocks visualchars code fullscreen",
      // "insertdatetime media nonbreaking save table contextmenu directionality",
      // "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;



    }
  };

  tinymce.init(editor_config);
</script>
