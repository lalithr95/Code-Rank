<?php

$response = shell_exec("g++ -o /opt/lampp/htdocs/test/test /opt/lampp/htdocs/test/test.cpp");
$response = shell_exec("./test");

echo $response;

$response = system("ls");
echo $response;
