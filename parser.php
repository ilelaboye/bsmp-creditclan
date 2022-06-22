<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    $xml=simplexml_load_file("amazon.xml") or die("Error: Cannot create object");
    echo('hello');
    print_r($xml->Message[0]->PunchOutOrderMessage[0]->ItemIn[1]['quantity']);
    
  ?>
  <script>
    
  </script>
</body>
</html>