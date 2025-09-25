<?php

namespace Bimp\Forge\Console\Input;

class InputManager {
    public static function ask(string $question): string{
        echo $question;
        $line = fgets(STDIN);
        return $line === false ? '' : trim($line);
    }

    public static function confirm(string $question, bool $default = true): bool {
        $suffix = $default ? '[S]' : '[N]';
        echo $question . ($question[strlen($question)-1] === ' ' ? '' : ' ').$suffix.' ';
        $line = fgets(STDIN);
        if($line === false) return $default;
        $ans = self::normalizer(trim($line));
        if ($ans === null) return $default;
        return $ans;
    }

    public static function normalizer(string $v): bool {
        if ($v === '') return null;
        $val = mb_strtolower($v, 'UTF-8');
        $val = str_replace('í','i',$val);
        $val = str_replace('sí','si',$val);

        $yes = ['s','si','y','yes','1','true'];
        $no  = ['n','no','0','false'];

        if (in_array($val, $yes, true)) return true;
        if (in_array($val, $no, true)) return false;

        return null;
    }

    public static function toBool(string $v): bool {
        $b = self::normalizer($v);
        if ($b !== null) return $b;
        return filter_var($v, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false;
    }
}