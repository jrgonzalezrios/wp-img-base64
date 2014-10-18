<?php
/* 
Plugin Name: wp-img-base64 upload
Plugin URI: http://www.yourpluginurlhere.com/ 
Version: 1.0
Author: jrgonzalezrios
Description: What does your plugin do and what features does it offer... 
*/ 

function img_create($filename, $mime_type) 
{  
  $content = file_get_contents($filename);
  $base64   = chunk_split(base64_encode($content)); 
  return ('data:image/' . $mime_type . ';base64,' . $base64);
    
}

add_filter( 'the_content', 'my_the_content_filter');

function my_the_content_filter( $content ) {

    //if ( is_single() )
         $doc = new DOMDocument();
         $doc->loadHTML($content);
        
        $tags = $doc->getElementsByTagName('img');
        
foreach ($tags as $tag) {
     $src= img_create($tag->getAttribute('src'),'image/png');
     $tag->setAttribute( 'src' , $src );
}   

    // Returns the content.
    return preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $doc->saveHTML());
}
//echo "<textarea cols='40'>".."</textarea>";
    



?> 
