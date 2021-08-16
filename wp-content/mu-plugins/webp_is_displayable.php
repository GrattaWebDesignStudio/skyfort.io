<?php
function valphoto_mime_types( $mime_types ) {
  $mime_types['webp'] = 'image/webp';     // Adding .webp extension
  return $mime_types;
}

add_filter( 'upload_mimes', 'valphoto_mime_types', 1, 1 );

function webp_is_displayable($result, $path) {
  if ($result === false) {
    $displayable_image_types = array( IMAGETYPE_WEBP ); 
    $info = @getimagesize( $path );
    if (empty($info)) {
      $result = false;
    } elseif (!in_array($info[2], $displayable_image_types)) {
      $result = false;
    } else {
      $result = true;
    }
  }
  return $result;
}

add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);