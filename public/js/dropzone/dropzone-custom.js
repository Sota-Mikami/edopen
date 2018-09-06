Dropzone.options.myDropzone= {
url: '/contents/confirm',
autoProcessQueue: false,
uploadMultiple: true,
parallelUploads: 5,
maxFiles: 5,
maxFilesize: 2,
acceptedFiles: 'image/*',
addRemoveLinks: true,
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
        // Now, find your CSRF token
        var token = $("input[name='_token']").val();
        // Append the token to the formData Dropzone is going to POST
        formData.append('_token', token);
        formData.append("title", jQuery("#title").val());
        formData.append("detail", jQuery("#detail").val());
        formData.append("price", jQuery("#price").val());
        formData.append("teaching_material", jQuery("#teaching_material").val());

    });
    this.on("successmultiple", function(files, response) {
        console.log('success');
      // Gets triggered when the files have successfully been sent.
      // Redirect user or notify of success.
    });
    this.on("errormultiple", function(files, response) {
        console.log('error');
      // Gets triggered when there was an error sending the files.
      // Maybe show form again, and notify user of error
    });
}
}
