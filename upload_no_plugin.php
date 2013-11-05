<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Ajax upload using plugin</title>
    
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
  var bar = document.getElementById('bar')
  var percent = document.getElementById('percent')
  var result = document.getElementById('result')
  var percentValue = "0%";
  
  var fileInput = document.getElementById('select-file');  
  var form = document.getElementById('form-upload');
  
  form.addEventListener('submit', function(evt) {
    // Chan khong cho form tao submit
    evt.preventDefault();
    
    // Ajax upload
    var file = fileInput.files[0];
    
    // fd dung de luu gia tri goi len
    var fd = new FormData();
    fd.append('file', file);
    
    // xhr dung de goi data bang ajax
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'file.php', true);
    
    xhr.upload.onprogress = function(e) {
      if (e.lengthComputable) {
        var percentValue = (e.loaded / e.total) * 100 + '%';
        percent.innerHTML  = percentValue;
        bar.setAttribute('style', 'width: ' + percentValue);
      }
    };
    
    xhr.onload = function() {
      if (this.status == 200) {
        result.innerHTML = this.response;        
      };
    };
    
    xhr.send(fd);
    
    
  }, false);
  
</script>