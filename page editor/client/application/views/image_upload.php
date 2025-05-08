<!--<!DOCTYPE html>  -->
<!-- <html>  -->
<!-- <head>  -->
<!--      <title>Webslesson | <?php echo $title; ?></title>  -->
<!--      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />  -->
<!--      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  -->
<!-- </head>  -->
<!-- <body>  -->
<!--      <div class="container">  -->
<!--           <br /><br /><br />  -->
<!--           <h3 align="center"><?php echo $title; ?></h3>  -->
<!--           <form method="post" id="upload_form" align="center" enctype="multipart/form-data">  -->
<!--                <input type="file" name="image_file" id="image_file" />  -->
<!--                <br />  -->
<!--                <br />  -->
<!--                <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-info" />  -->
<!--           </form>  -->
<!--           <br />  -->
<!--           <br />  -->
<!--           <div id="uploaded_image">  -->
<!--           </div>  -->
<!--      </div>  -->
<!-- </body>  -->
<!-- </html>  -->
<!-- <script>  -->
<!-- $(document).ready(function(){  -->
<!--      $('#upload_form').on('submit', function(e){  -->
<!--           e.preventDefault();  -->
<!--           if($('#image_file').val() == '')  -->
<!--           {  -->
<!--                alert("Please Select the File");  -->
<!--           }  -->
<!--           else  -->
<!--           {  -->
<!--                $.ajax({  -->
<!--                     url:"<?php echo base_url(); ?>map/ajax_upload",   -->
<!--                     method:"POST",  -->
<!--                     data:new FormData(this),  -->
<!--                     contentType: false,  -->
<!--                     cache: false,  -->
<!--                     processData:false,  -->
<!--                     success:function(data)  -->
<!--                     {  -->
<!--                          $('#uploaded_image').html(data);  -->
<!--                     }  -->
<!--                });  -->
<!--           }  -->
<!--      });  -->
<!-- });  -->
<!-- </script>  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Upload files using Codeigniter and Ajax</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="col-sm-4 col-md-offset-4">
        <h4>Upload files using Codeigniter and Ajax</h4>
            <form class="form-horizontal" id="submit">
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Title">
                </div>
                <div class="form-group">
                    <input type="file" name="file">
                </div>
 
                <div class="form-group">
                    <button class="btn btn-success" id="btn_upload" type="submit">Upload</button>
                </div>
            </form>   
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
 
        $('#submit').submit(function(e){
            e.preventDefault(); 
                 $.ajax({
                     url:'<?php echo base_url();?>map/do_upload',
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                      success: function(data){
                          alert("Upload Image Successful.");
                   }
                 });
            });
         
 
    });
     
</script>
</body>
</html>