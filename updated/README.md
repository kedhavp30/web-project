# Web Project

  $curl = curl_init(); // Initializes new cURL session

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost/onlinestore/api/product/readSingle.php?id=' . $_GET['productId'],
    CURLOPT_RETURNTRANSFER => true, // Return transfer as a string
    CURLOPT_ENCODING => '', // Encodings the client can understand; "" => all supported types sent
    CURLOPT_MAXREDIRS => 10, // Max number of redirections
    CURLOPT_TIMEOUT => 0, // Max time the request can take; 0 => never timeouts during transfer
    CURLOPT_FOLLOWLOCATION => true, // Follow location headers sent as part of http header
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
  ));

  $response = curl_exec($curl); // Executes cURL request and returns response

  curl_close($curl); // Closes a cURL session and frees all resources