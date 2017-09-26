$(document).ready(function() { 
   $('#imgUpload').submit(function(e) {  
    if($('#fileToUpload').val()) {
      e.preventDefault();
      $('#loader-icon').show();
      $('#progress-div').show();
      $(this).ajaxSubmit({ 
        target:   '#targetLayer', 
        beforeSubmit: function() {
          $("#progress-bar").width('0%');
        },
        uploadProgress: function (event, position, total, percentComplete){ 
          $("#progress-bar").width(percentComplete + '%');
          $("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
        },
        success:function (){
          $('#loader-icon').hide();
        },
        resetForm: true 
      }); 
      return false; 
    }
  });
}); 