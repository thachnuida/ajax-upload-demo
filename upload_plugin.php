<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Ajax upload using plugin</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="js/jquery.form.js"></script>
    
  <style>
    #form-upload { padding: 10px; background: #A5CCFF; border-radius: 5px;}
    #progress { border: 1px solid #ccc; width: 500px; height: 20px; margin-top: 10px;text-align: center;position: relative;}
    #bar { background: #F39A3A; height: 20px; width: 0px;}
    #percent { position: absolute; left: 50%; top: 0px;}
  </style>
</head>

<body>
  <h1>Upload file using Form plugin</h1>
  
  <form id="form-upload" method="post" action="file.php" enctype="multipart/form-data">
    <input type="file" name="file" id="select-file"/>
    <input type="submit" value="Upload" id="submit-upload"/>
  </form>
  
  <div id="progress">
    <div id="bar"></div>
    <div id="percent">0%</div>
  </div>
  
  <div id="result">
  </div>
  
</body>
</html>

<script>
  var bar = $('#bar');
  var percent = $('#percent');
  var result = $('#result');
  var percentValue = "0%";
  
  $('#form-upload').ajaxForm({
      // Do something before uploading
      beforeUpload: function() {
        result.empty();
        percentValue = "0%";
        bar.width = percentValue;
        percent.html(percentValue);
      },
      
      // Do somthing while uploading
      uploadProgress: function(event, position, total, percentComplete) {
        var percentValue = percentComplete + '%';
        bar.width(percentValue)
        percent.html(percentValue);
      },
      
      // Do something while uploading file finish
      success: function() {
        var percentValue = '100%';
        bar.width(percentValue)
        percent.html(percentValue);
      },
      
      // Add response text to div #result when uploading complete
      complete: function(xhr) {      
        $('#result').html(xhr.responseText);
      }
  });
</script>