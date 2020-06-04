<?php



$files = getDirContents('./');
$translates = json_decode(file_get_contents('path to translates'),true);
foreach ($files as $file) {
    $text = file_get_contents($file);
    foreach ($translates as $key=>$value) {
        $text =  str_replace("window.Vue.i18n.translate('".$key."')", $value, $text);
        $text =  str_replace("window.Vue.i18n.translate('".$key."' )", $value, $text);
        $text =  str_replace("window.Vue.i18n.translate( '".$key."' )", $value, $text);
        $text =  str_replace("window.Vue.i18n.translate( '".$key."')", $value, $text);
        $text =  str_replace('_vm._s(_vm.$t(\''.$key.'\')', $value, $text);
        $text =  str_replace('{{$t(\''.$key.'\')}}', $value, $text);
        $text =  str_replace('{{$t(\''.$key.'\') }}', $value, $text);
        $text =  str_replace('{{ $t(\''.$key.'\') }}', $value, $text);
        $text =  str_replace('{{ $t(\''.$key.'\')}}', $value, $text);
        $text =  str_replace($key, $value, $text);
        file_put_contents($file,$text);
    }
}

function getDirContents($dir, &$results = array(), $extension = 'js') {
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path) && pathinfo($path)['extension']===$extension) {
            $results[] = $path;
        } else if ($value != "." && $value != "..") {
            getDirContents($path, $results);
            if(pathinfo($path)['extension']===$extension){
                $results[] = $path;
            }
        }
    }

    return $results;
}
