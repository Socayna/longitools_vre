var baseURL = $('#base-url').val();

var FormDropzone = function () {
   
    var queryArray = [];

    return {
      //main function to initiate the module
      init: function () {  
				var count_added = 0;
				var count_uploaded = 0;
				Dropzone.options.myDropzone = {
					dictDefaultMessage: "Drop files here or click to upload",
					dictResponseError: "Error message",
					maxFilesize: maxUpSize,
					timeout: 0,
					success: function (file, response) {
						d = response.replace(/(\r\n|\n|\r|\t)/gm,"");
						console.log('response=',d);
						this.on("complete", function (file) {
							console.log('file loaded', d);
							if((queryArray.indexOf(d) == -1) && (d != '0'))	queryArray.push(d);
								
							if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
								
								//TODO No se com ferho
								//if(response == '0'){
								//	print nicely $_SESSION['errorData'];
								//}else{
								//	location.href="uploadForm2.php?fn[]="+responsefile1+"&fn[]"+responsefile2
								//}
								//queryArray.pop();
								if(queryArray.length > 0) {
									queryString = '?fn[]=' + queryArray.join('&fn[]=');
									location.href= baseURL + "getdata/uploadForm2.php" + queryString;
								}else{
									console.log('response=',d);
									$('.alert-error-uploading').show();
									location.href= baseURL + "getdata/uploadForm.php";
								}
								//console.log("uploadForm2.php" + queryString);
							}
						});
					}
				}
    	}
  	};

}();

jQuery(document).ready(function() {    
   FormDropzone.init();
});
