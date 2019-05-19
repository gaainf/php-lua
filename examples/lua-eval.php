<?php

/**
 * The example of Lua->eval method
 */

$lua = new Lua();
$input_data = file_get_contents("php://stdin");
$result = '';
$error = null;
ob_start();
try {
    $lua->eval($input_data);
    $result = ob_get_contents();
} catch (LuaException $e) {
    $error = $e;
}
ob_end_clean();

if ($error == null) {
    print("Ok" . PHP_EOL);
    print("Result: " . $result . PHP_EOL);
} else {
    print("Failed" . PHP_EOL);
    $error->getCode() == LUA_ERRSYNTAX;
    print("Error: " . $error->getMessage() . PHP_EOL);
    exit(1);
}

?>
