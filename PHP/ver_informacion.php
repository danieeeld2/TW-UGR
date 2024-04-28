<?php
    // Comprobacion de los datos
    $http_user_agent_present = isset($_SERVER['HTTP_USER_AGENT']);
    $http_host_present = isset($_SERVER['HTTP_HOST']);
    $http_accept_present = isset($_SERVER['HTTP_ACCEPT']);
    $http_accept_encoding_present = isset($_SERVER['HTTP_ACCEPT_ENCODING']);
    $http_connection_present = isset($_SERVER['HTTP_CONNECTION']);
    $server_software_present = isset($_SERVER['SERVER_SOFTWARE']);
    $server_signature_present = isset($_SERVER['SERVER_SIGNATURE']);
    $document_root_present = isset($_SERVER['DOCUMENT_ROOT']);
    $server_proto_present = isset($_SERVER['SERVER_PROTOCOL']);
    $php_self_present = isset($_SERVER['PHP_SELF']);
    $request_uri_present = isset($_SERVER['REQUEST_URI']);
    $query_string_present = isset($_SERVER['QUERY_STRING']);
    $script_filename_present = isset($_SERVER['SCRIPT_FILENAME']);
    $script_name_present = isset($_SERVER['SCRIPT_NAME']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php echo "<h1>Variables recibidas</h1>";
    showVar($_SERVER,'Desde $_SERVER');
    function showVar($var,$msg) {
        echo "<h2>$msg</h2>";
        echo "<ul>";
        foreach ($var as $c => $v) {
        if (is_array($v)) {
            echo "<li>$c = <span class='valor'>";
            print_r($v);
            echo "</span></li>";
        } 
        else
            echo "<li>$c = <span class='valor'>$v</span></li>";
        }
        echo "</ul>";
    }
?>
    <h2>Lista de disponibilidad de los datos del enunciado:</h2>
    <ul>
        <li>HTTP_USER_AGENT: <?php echo $http_user_agent_present ? 'Presente' : 'No presente'; ?></li>
        <li>HTTP_HOST: <?php echo $http_host_present ? 'Presente' : 'No presente'; ?></li>
        <li>HTTP_ACCEPT: <?php echo $http_accept_present ? 'Presente' : 'No presente'; ?></li>
        <li>HTTP_ACCEPT_ENCODING: <?php echo $http_accept_encoding_present ? 'Presente' : 'No presente'; ?></li>
        <li>HTTP_CONNECTION: <?php echo $http_connection_present ? 'Presente' : 'No presente'; ?></li>
        <li>SERVER_SOFTWARE: <?php echo $server_software_present ? 'Presente' : 'No presente'; ?></li>
        <li>SERVER_SIGNATURE: <?php echo $server_signature_present ? 'Presente' : 'No presente'; ?></li>
        <li>DOCUMENT_ROOT: <?php echo $document_root_present ? 'Presente' : 'No presente'; ?></li>
        <li>SERVER_PROTOCOL: <?php echo $server_proto_present ? 'Presente' : 'No presente'; ?></li>
        <li>PHP_SELF: <?php echo $php_self_present ? 'Presente' : 'No presente'; ?></li>
        <li>REQUEST_URI: <?php echo $request_uri_present ? 'Presente' : 'No presente'; ?></li>
        <li>QUERY_STRING: <?php echo $query_string_present ? 'Presente' : 'No presente'; ?></li>
        <li>SCRIPT_FILENAME: <?php echo $script_filename_present ? 'Presente' : 'No presente'; ?></li>
        <li>SCRIPT_NAME: <?php echo $script_name_present ? 'Presente' : 'No presente'; ?></li>
    </ul>
</body>
</html>