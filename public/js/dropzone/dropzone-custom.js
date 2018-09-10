Dropzone.options.myDropzone= {
url: '/contents/confirm',
autoProcessQueue: false,
uploadMultiple: true,
parallelUploads: 5,
maxFiles: 5,
maxFilesize: 2,
acceptedFiles: 'image/*',
addRemoveLinks: true,
error: function(data) {
       console.log(data);
       // console.log(errorMessage);
       // console.log(xhr);
   },
init: function() {
    dzClosure = this; // Makes sure that 'this' is understood inside the functions below.
    console.log(this);
    // for Dropzone to process the queue (instead of default form behavior):
    document.getElementById("submit-all").addEventListener("click", function(e) {
        // Make sure that the form isn't actually being sent.
        e.preventDefault();
        e.stopPropagation();
        dzClosure.processQueue();
    });
    //send all the form data along with the files:
    this.on("sendingmultiple", function(data, xhr, formData) {


        var token = $("input[name='_token']").val();
        formData.append('_token', token);
        formData.append("title", $("#title").val());
        formData.append("detail", $("#detail").val());
        formData.append("price", $("#price").val());
        formData.append("teaching_material", $("input[name='teaching_material']").prop("files")[0]);

    });
    this.on("successmultiple", function(files, response) {


        console.log('success');
        window.location.href = "/contents/confirm";
    });
    this.on("errormultiple", function(files, response) {
        console.log('error');
        // console.log(files);
        // console.log(response);
    });
}
}

$('form').validate({
      rules: {
        title: {
          required: true
        },
        detail: {
          required: true
        },
        price: {
          required: true
        },
      },
      messages: {
        title: {
          required: '教材名を入力して下さい'
        },
        detail: {
          required: '教材の詳細説明を入力して下さい',
        },
        price: {
          required: '価格を入力して下さい',
        },
      }
});
