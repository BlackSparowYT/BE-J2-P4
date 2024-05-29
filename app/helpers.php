<?php


    if (! function_exists('vel_set_page_meta')) {
        function vel_set_page_meta($custom = null) {
            global $site;
            if ($custom) {
                echo "<meta name='description' content='$custom'>";
            } else {
                echo "<meta name='description' content='". env("APP_DESCRIPTION") ."'>";
            }
            echo '
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
            ';
        }
    }

    if (! function_exists('vel_set_social_meta')) {
        function vel_set_social_meta() {
            echo '
                <meta property="og:title" content="' . env("APP_NAME") . '">
                <meta property="og:description" content="'. env("APP_DESCRIPTION") .'">
                <meta property="og:image" content="'. env("APP_URL") .'">
                <meta property="og:url" content="'. env("APP_URL") .'">

                <meta name="twitter:title" content="Add title here">
                <meta name="twitter:description" content="'. env("APP_DESCRIPTION") .'">
                <meta name="twitter:image" content="'. env("APP_URL") .'">
                <meta name="twitter:url" content="'. env("APP_URL") .'">
            ';
        }
    }



    if (! function_exists('vel_site_lang')) {
        //vel_site_lang();
        function vel_site_lang() {
            if(isset($_COOKIE['site_lang'])) {
                return;
            }

            $location = strtolower(vel_get_user_location());

            if ($location == 'nl') {
                setcookie('site_lang', 'nl', time() + (86400 * 30), "/"); // 86400 = 1 day * 30 (1 month)
            } else {
                setcookie('site_lang', 'en', time() + (86400 * 30), "/"); // 86400 = 1 day * 30 (1 month)
            }

            header("Refresh:0");
        }
    }


    if (! function_exists('vel_get_user_location')) {
        function vel_get_user_location() {
            /* return 'nl'; */

            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            } else if (isset($_SERVER['HTTP_FORWARDED'])) {
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            } else if (isset($_SERVER['REMOTE_ADDR'])) {
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            } else {
                $ipaddress = '1.1.1.1';
            }

            if ($ipaddress == "127.0.0.1") {
                return "nl";
            }

            $json = json_decode(file_get_contents("http://ipinfo.io/$ipaddress/json"), true);
            return $json['country'];
        }
    }





    if (! function_exists('vel_number_format')) {
        function vel_number_format($input, $decimals){
            return number_format($input, $decimals, '.', ',');
        }
    }

    if (! function_exists('vel_slugify')) {
        function vel_slugify($string) {
            return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
        }
    }

    if (! function_exists('vel_emailfy')) {
        function vel_emailfy($name) {
            $email = strtolower($name);
            $email = str_replace('.', '', $email);
            $email = str_replace(' ', '.', $email);
            $email = $email . '@' . vel_get_app_domain();
            return $email;
        }
    }

    if (! function_exists('vel_start_slash_it')) {
        function vel_start_slash_it($string) {
            $string = trim($string, '/');
            $string = '/' . $string;
            return preg_replace('#/+#', '/', $string);
        }
    }

    if (!function_exists('vel_end_slash_it')) {
        function vel_end_slash_it($string)
        {
            $string = rtrim($string, '/');
            $string .= '/';
            return preg_replace('#/+#', '/', $string);
        }
    }

    if (! function_exists('vel_get_account_url')) {
        function vel_get_account_url() {
            $url = !empty(env('SETTING_ACCOUNT_URL')) ? env('SETTING_ACCOUNT_URL') : 'account';
            return vel_start_slash_it($url);
        }
    }

    if (! function_exists('vel_get_admin_url')) {
        function vel_get_admin_url() {
            $url = !empty(env('SETTING_ADMIN_URL')) ? env('SETTING_ADMIN_URL') : 'admin';
            return vel_start_slash_it($url);
        }
    }

    if (! function_exists('vel_get_app_domain')) {
        function vel_get_app_domain() {
            $domain = env('APP_DOMAIN');
            $domain = str_replace(['http:', 'https:', '/'], '', $domain);
            return $domain;
        }
    }

    if (! function_exists('vlx_get_env_string')) {
        function vlx_get_env_string($env_key) {

            $string = env($env_key);
            $string = vlx_format($string);

            return $string;
        }
    }

    if (! function_exists('vlx_format')) {
        function vlx_format($string) {

            if(str_contains($string, '_')) { $string = str_replace('_', ' ', $string); }
            if(str_contains($string, ';')) { $string = str_replace(';', '', $string); }

            return $string;
        }
    }

    if (! function_exists('vlx_format_route_name')) {
        function vlx_format_route_name($string) {
            $string = explode('.', $string)[0];
            $string = str_replace('-', ' ', $string);
            $string = ucwords($string);
            return $string;
        }
    }

    if (! function_exists('vlx_format_route_name')) {
        function vlx_make_uuid() {
            // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
            $data = random_bytes(16);
            assert(strlen($data) == 16);

            // Set version to 0100
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
            // Set bits 6-7 to 10
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

            // Output the 36 character UUID.
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }
    }

?>
