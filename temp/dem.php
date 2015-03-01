<?php

$response = shell_exec("g++ -o /tmp/test/helloworld /tmp/test/helloworld.cpp");
$response = shell_exec("./helloworld");

echo $response;
