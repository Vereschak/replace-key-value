<?php



$files = getDirContents('./static/');
$translates = json_decode(file_get_contents($argv[1]),true);
foreach ($files as $file) {
    if (is_dir($text)) {
         continue;
    }
    else if ($text == "." && $text == "..") {
        continue;
    } 
    $text = file_get_contents($file);
    foreach ($translates as $key=>$value) {
        $text =  str_replace("window.Vue.i18n.translate('".$key."')", "'".$value."'", $text);
        $text =  str_replace("window.Vue.i18n.translate('".$key."' )", "'".$value."'", $text);
        $text =  str_replace("window.Vue.i18n.translate( '".$key."' )", "'".$value."'", $text);
        $text =  str_replace("window.Vue.i18n.translate( '".$key."')", "'".$value."'", $text);
        $text =  str_replace('_vm._s(_vm.$t(\''.$key.'\')', "'".$value."'", $text);
        $text =  str_replace('{{$t(\''.$key.'\')}}', $value, $text);
        $text =  str_replace('{{$t(\''.$key.'\') }}', $value, $text);
        $text =  str_replace('{{ $t(\''.$key.'\') }}', $value, $text);
        $text =  str_replace('{{ $t(\''.$key.'\')}}', $value, $text);
        
        
        $text =  str_replace("window.Vue.i18n.translate(\"".$key."\")", "'".$value."'", $text);
        $text =  str_replace("window.Vue.i18n.translate(\"".$key."\" )", "'".$value."'", $text);
        $text =  str_replace("window.Vue.i18n.translate( \"".$key."\" )", "'".$value."'", $text);
        $text =  str_replace("window.Vue.i18n.translate( \"".$key."\")", "'".$value, $text);
        $text =  str_replace('_vm._s(_vm.$t("'.$key.'")', "'".$value."'", $text);
        $text =  str_replace('{{$t("'.$key.'")}}', $value, $text);
        $text =  str_replace('{{$t("'.$key.'") }}', $value, $text);
        $text =  str_replace('{{ $t("'.$key.'") }}', $value, $text);
        $text =  str_replace('{{ $t("'.$key.'")}}', $value, $text);
       
    }
    
    file_put_contents($file,$text);
    
}

function getDirContents($dir, &$results = array()) {
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            $results[] = $path;
        } else if ($value != "." && $value != "..") {
            getDirContents($path, $results);
             $results[] = $path;
            
        }
    }

    return $results;
}
