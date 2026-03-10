@php
$album = getGalleryAlbum();
$i = 0;
    foreach($album->client as $a){
        $client[$i]=($album->client);
        $i++;
    }
@endphp
