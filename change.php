<?php


$t = '$t';
$files = getDirContents('./');
$translates = json_decode(file_get_contents($argv[1]),true);
$count = count($files);
$i = 0;

foreach ($files as $file) {
    $i++;
    echo ".";
    if($i%30==0){
        echo "\n ".round($i/$count*100,2)." \n";
    }
    if (is_dir($file)) {
        continue;
    }
    else if ($file == "." && $file == "..") {
        continue;
    }
    $text = file_get_contents($file);
    foreach ($translates as $key=>$value) {

          $text =  str_replace("window.Vue.i18n.translate('".$key."')", "\"".$value."\"", $text);
        $text =  str_replace("window.Vue.i18n.translate('".$key."' )", "\"".$value."\"", $text);
        $text =  str_replace("window.Vue.i18n.translate( '".$key."' )", "\"".$value."\"", $text);
        $text =  str_replace("window.Vue.i18n.translate( '".$key."')", "\"".$value."\"", $text);
        
        $text =  str_replace('{{$t(\''.$key.'\')}}', $value, $text);
        $text =  str_replace('{{$t(\''.$key.'\') }}', $value, $text);
        $text =  str_replace('{{ $t(\''.$key.'\') }}', $value, $text);
        $text =  str_replace('{{ $t(\''.$key.'\')}}', $value, $text);
        
        
        $text =  str_replace("window.Vue.i18n.translate(\"".$key."\")", "\"".$value."\"", $text);
        $text =  str_replace("window.Vue.i18n.translate(\"".$key."\" )", "\"".$value."\"", $text);
        $text =  str_replace("window.Vue.i18n.translate( \"".$key."\" )", "\"".$value."\"", $text);
        $text =  str_replace("window.Vue.i18n.translate( \"".$key."\")", "\"".$value."\"", $text);
  
        $text =  str_replace('{{$t("'.$key.'")}}', $value, $text);
        $text =  str_replace('{{$t("'.$key.'") }}', $value, $text);
        $text =  str_replace('{{ $t("'.$key.'") }}', $value, $text);
        $text =  str_replace('{{ $t("'.$key.'")}}', $value, $text);
        

        $text =  str_replace('="$t(\''.$key.'\')"', '=\'"'.$value.'"\'', $text);/* :title="$t('market.top_filer.hot')" => ='"some text"' */
        $text =  str_replace('="$t(\''.$key.'\')', '="\''.addslashes($value).'\'', $text);/*v-text="$t('market.top_filer.hot') + ' | ' =>   v-text="ssssssss" + ' | '"*/ 

    }

    file_put_contents($file,$text);

}

function getDirContents($dir, &$results = array()) {
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            $results[] = $path;
        } else if ($value != "." && $value != ".." ) {
            getDirContents($path, $results);
            $results[] = $path;

        }
    }

    return $results;
}
