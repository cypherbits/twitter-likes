<?php declare(strict_types=1);

$media_folder = "media";
set_time_limit(0);

if (!file_exists($media_folder) && !mkdir($media_folder) && !is_dir($media_folder)) {
    throw new \RuntimeException(sprintf('Directory "%s" was not created', $media_folder));
}

$ndjson_file = "favs.ndjson";

$arrTwits = explode("\n", file_get_contents($ndjson_file));

foreach ($arrTwits as $twit) {

    $dTwit = json_decode($twit, true);

    if (isset($dTwit['extended_entities'])){
        $medias = $dTwit['extended_entities']['media'];
        foreach ($medias as $media) {
            $type = $media['type'];
            $download_url = null;
            switch ($type) {
                case 'animated_gif':
                    $download_url = $media['video_info']['variants'][0]['url'];
                    break;
                case 'photo':
                    $download_url = $media['media_url_https'];
                    break;
                case 'video':
                    $download_url = $media['video_info']['variants'][count($media['video_info']['variants'])-2]['url'];
                    break;
            }
            if ($download_url !== null){
                exec("wget " . $download_url . " --connect-timeout=5 --tries=2 -N -P ./" . $media_folder);
            }
        }
    }else{
        echo "Twit ID ". $dTwit['id'] . ' does not have extended_entities (does not have media)\n';
    }
}
