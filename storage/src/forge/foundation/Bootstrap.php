<?php

namespace Bimp\Forge\Foundation;

final class Bootstrap {

    public static function ensure(string $base) : void {
        $autoload = $base . "/vendor/autoload.php";
        if(@include $autoload) return;

        $install = $base . "/bin/install.sh";
        if(is_file($install)){
            self::run("bash".escapeshellarg($install), $base);
            if(@include $autoload) return;
        }

        fwrite(STDERR, "Falta vendor/. Ejecuta 'composer install' o './bin/install.sh'.\n");
        exit(1);
    }

    private static function run(string $cmd, string $cwd): void {
        $proc = proc_open($cmd, [0=>STDIN,1=>STDOUT,2=>STDERR], $pipes, $cwd);
        if (is_resource($proc)) proc_close($proc);
    }

}