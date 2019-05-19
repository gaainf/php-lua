<?php

/**
 * The example of lua syntax validator
 */

/**
 * Execute shell command and get stdout and stderr
 * 
 * @param string $cmd Shell command
 * 
 * @return array [exit_code, stdout, stderr]
 */
function myShellExec($cmd)
{
    $proc = proc_open(
        $cmd, [
            1 => ['pipe','w'],
            2 => ['pipe','w'],
        ], $pipes
    );
    $stdout = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[2]);
    $exit_code = proc_close($proc);
    return [$exit_code, $stdout, $stderr];
}

$input_filename = $argv[1];
$result = myShellExec("luac -p $input_filename");

if ($result[0] == 0) {
    print("Syntax is valid" . PHP_EOL);
} else {
    print("Syntax is invalid" . PHP_EOL);
    print("Error: " . $result[2] . PHP_EOL);
    exit(1);
}

?>
