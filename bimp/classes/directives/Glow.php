<?php

namespace Bimp\Forge\Directives;


class Glow{
    public static function Parse(string $content): string {
        $layout = null;
        $sections = [];

        // Paso 1: Detectar layout
        if (preg_match('/@layout\(\'(.*?)\'\)/', $content, $match)) {
            $layout = $match[1];
            $content = str_replace($match[0], '', $content);
        }

        // Paso 2: Capturar secciones
        preg_match_all('/@section\(\'(.*?)\'\)(.*?)@endsection/s', $content, $matches, PREG_SET_ORDER);
        foreach ($matches as $m) {
            $sections[$m[1]] = trim($m[2]);
            $content = str_replace($m[0], '', $content);
        }

        // Paso 3: Si hay layout, cargar y reemplazar @yield()
        if ($layout) {
            $layoutPath = LAYOUTS . $layout . 'View.php';

            if (!file_exists($layoutPath)) {
                throw new \Exception("El layout '{$layout}' no existe en {$layoutPath}");
            }

            $layoutContent = file_get_contents($layoutPath);

            foreach ($sections as $name => $html) {
                $layoutContent = preg_replace("/@yield\(\'{$name}\'\)/", $html, $layoutContent);
            }

            // Ahora procesamos el resultado del layout
            $content = $layoutContent;
        }

        // Paso 4: Procesar directivas Blade-like
        $content = preg_replace_callback('/@Includes\(\'(.*?)\'\);?/', fn($m) =>
            "<?php require_once INCLUDES . '{$m[1]}.php'; ?>", $content);

        $content = preg_replace_callback('/@components\(\'(.*?)\'\);?/', fn($m) =>
            "<?php require_once COMPONENTS . '{$m[1]}.php'; ?>", $content);

        $content = preg_replace('/\{\{\s*\$(.*?)\s*\}\}/', '<?php echo $$1; ?>', $content);
        $content = preg_replace('/@if\s*\((.*?)\)/', '<?php if ($1): ?>', $content);
        $content = preg_replace('/@endif/', '<?php endif; ?>', $content);
        $content = preg_replace('/@foreach\s*\((.*?)\)/', '<?php foreach ($1): ?>', $content);
        $content = preg_replace('/@endforeach/', '<?php endforeach; ?>', $content);

        return $content;
    }

}