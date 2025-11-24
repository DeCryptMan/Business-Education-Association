<?php
declare(strict_types=1);

namespace Core;

class AutoTranslator {
    private static string $cacheFile = __DIR__ . '/../storage/translations_cache.json';
    private static array $cache = [];
    private static bool $isLoaded = false;
    private static bool $hasChanges = false;

    private static function loadCache(): void {
        if (!self::$isLoaded) {
            if (file_exists(self::$cacheFile)) {
                $json = file_get_contents(self::$cacheFile);
                self::$cache = json_decode($json, true) ?? [];
            }
            self::$isLoaded = true;
        }
    }
    public static function saveCache(): void {
        if (self::$hasChanges) {
            $dir = dirname(self::$cacheFile);
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            file_put_contents(self::$cacheFile, json_encode(self::$cache, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }
    }

    public static function translate(string $text, string $targetLang): string {
        if (trim($text) === '' || is_numeric($text)) {
            return $text;
        }
        self::loadCache();
        $key = md5($text);
        if (isset(self::$cache[$targetLang][$key])) {
            return self::$cache[$targetLang][$key];
        }
        $translated = self::fetchGoogleTranslation($text, $targetLang);
        self::$cache[$targetLang][$key] = $translated;
        self::$hasChanges = true;

        return $translated;
    }
    private static function fetchGoogleTranslation(string $text, string $targetLang): string {
        $url = "https://translate.googleapis.com/translate_a/single?client=gtx&dt=t&sl=auto&tl=" . $targetLang . "&q=" . urlencode($text);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Для локальной разработки
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64)");
        
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response) {
            $data = json_decode($response, true);
            // Google возвращает массив массивов, собираем текст обратно
            if (isset($data[0]) && is_array($data[0])) {
                $result = '';
                foreach ($data[0] as $part) {
                    $result .= $part[0] ?? '';
                }
                return $result ?: $text;
            }
        }

        return $text;
    }
}