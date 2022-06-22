<?php
session_start();
$raw = file_get_contents("php://input");

$response = $_POST['cxml-urlencoded'];
$response = urldecode($response);

$dom = new DOMDocument();
$dom->loadXML($response);
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$cxml = $dom->saveXML();
$cxml = htmlentities($cxml);
$dxml = simplexml_load_string($cxml) or die("Error: Cannot create object");

?><!doctype html>
<html lang="en">
 <head>
  <meta charset="utf-8">
  <title>Punch Out Hook!</title>
  <script type="text/javascript" src="sh_main.min.js"></script>
  <script type="text/javascript" src="sh_xml.min.js"></script>
  <link type="text/css" rel="stylesheet" href="sh_emacs.min.css" />
 </head>

 <body onload="sh_highlightDocument();">
  <a href="./">&laquo; Punch again</a>
  <hr />
  <h2>PunchOut Callback</h2>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach($xml->Message[0]->PunchOutOrderMessage[0]->ItemIn as $item){ ?>
          <tr>
            <td> <?php echo($item->ItemDetail->Description); ?> </td>
            <td> <?php echo($item['quantity']); ?> </td>
            <td> <?php echo($item->ItemDetail->UnitPrice->Money['currency'] + $item->ItemDetail->UnitPrice->Money); ?> </td>
          </tr>
      <?php  }
      ?>
    </tbody>
  </table>

  <hr />
  <h2>POST    </h2> <pre><? print_r($_POST);    ?></pre>
  <h2>GET     </h2> <pre><? print_r($_GET);     ?></pre>
  <h2>SESSION </h2> <pre><? print_r($_SESSION); ?></pre>
  <h2>COOKIE  </h2> <pre><? print_r($_COOKIE);  ?></pre>
  <h2>SERVER  </h2> <pre><? print_r($_SERVER);  ?></pre>
  <h2>RAW     </h2> <pre><? print_r($raw);  ?></pre>
 </body>
</html>
