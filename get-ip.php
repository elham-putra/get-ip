<?php 

$msg = "";
$result = "";

if (isset($_POST["gas"])){
  $ip_address = $_POST["ip_address"];

  $url = "http://ip-api.com/json/" . $ip_address;
  $content = file_get_contents($url);
  $json = json_decode($content);
  if ($json->status == "fail"){
    $failmsg = ucfirst($json->message);
    $msg = "<div class='alert alert-danger'>{$failmsg}</div>";
  } else {
    $result = '<table class="table table-bordered">
     <thead>
       <tr>
           <th scope="col">IP Address</th>
           <th scope="col">Country</th>
           <th scope="col">Region Name</th>
           <th scope="col">City</th>
           <th scope="col">Zip</th>
           <th scope="col">Latitude</th>
           <th scope="col">Longtitude</th>
           <th scope="col">Timezone</th>
       </tr>
     </thead>
     <tbody>
       <tr>
          <th scope="row">'.$json->query.'</th>
          <td>'.$json->country.'('.$json->countryCode.')</td>
          <td>'.$json->regionName.'</td>
          <td>'.$json->city.'</td>
          <td>'.$json->zip.'</td>
          <td>'.$json->lat.'</td>
          <td>'.$json->lon.'</td>
          <td>'.$json->timezone.'</td>
       </tr>
     </tbody>
    </table>';
  }
}


?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <title></title>
</head>
<body>

  <div class="container py-5">
    <div class="row">
      <div class="col-lg-5 col-md-8 col-12 mx-auto">
        <div class="card rounded bg-white border p-4">
          <div class="card-body">
            <h3 calss="card-title mb-3">Get IP Address Details</h3>
            <?php echo $msg; ?>
            <form action="" method="POST">
              <div class="mb-3">
                <label for="ip_address" class="form-label">IP Address</label>
                <input type="text" class="form-control" id="ip_address" name="ip_address" value="127.0.0.1">
              </div>
              <button type="submit" name="gas" class="btn btn-primary">Gas</button>
            </form>

          </div>
        </div>
      </div>
    </div>

    <div class="mt-5">
      <?php echo $result; ?>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>