/*
Plugin Name: Posts Relacionados
Description: Muestra posts relacionados en medio de los artículos
Author: entreunosyceros
Web: https://entreunosyceros.net
Version: 1.0
*/
// Toma el contenido de un post y lo divide en párrafos. Si el usuario no está viendo un post individual, el contenido se devuelve sin cambios
function related_posts_after_paragraphs($content) {
    if(!is_single()) {
        return $content;
    }
    $related_posts = get_related_posts(); // Se utiliza para obtener posts relacionados utilizando los tags del post actual
    
    if(empty($related_posts)) {
        return $content;
    }
    $paragraphs = explode("</p>", $content);
    $insert_point = floor(count($paragraphs) / 2); // Los artículos relacionados aparecen después de la mitad de los párrafos
    // "related_posts_html" contiene el código HTML que se insertará en el contenido del post.
    $related_posts_html = '<hr/>';
    $related_posts_html .= '<div class="related-posts">';
    $related_posts_html .= '<h3>Esto también te puede interesar</h3>';
    $related_posts_html .= '<ul>';
    foreach($related_posts as $related_post) {
        $related_posts_html .= '<li><a href="'.get_permalink($related_post->ID).'" target="_blank" title="'.get_the_title($related_post->ID).'">'.get_the_title($related_post->ID).'</a></li>';
    }
    $related_posts_html .= '</ul>';
    $related_posts_html .= '</div>';
    $related_posts_html .= '<hr/>';
    $paragraphs[$insert_point] .= $related_posts_html;
    return implode("</p>", $paragraphs);
}
// El filtro "the_content" se utiliza para aplicar la función "related_posts_after_paragraphs" al contenido de los posts.
add_filter('the_content', 'related_posts_after_paragraphs');
//Esta función se llama "get_related_posts" y su objetivo es obtener y devolver los posts relacionados al post actual. 
//La función utiliza el objeto global $post para obtener el ID del post actual. 
function get_related_posts() {
    global $post;
    $tags = wp_get_post_tags($post->ID);
    if(empty($tags)) {
        return array();
    }
    $tag_ids = array();
    foreach($tags as $tag) {
        $tag_ids[] = $tag->term_id;
    }
    $query = new WP_Query(array(
        'tag__in' => $tag_ids,
        'post__not_in' => array($post->ID),
        'posts_per_page' => 3, 
    ));
    return $query->posts;
}
// "related_posts_styles" se utiliza para añadir estilos CSS al contenido de los posts.
function related_posts_styles() {
    if(!is_single()) {
        return;
    }
    ?>
    <style>
        .related-posts {
            margin: 20px 0;
            text-align: center;
        }
        .related-posts h3 {
            margin: 0;
            padding: 0;
            font-size: 1.2em;
            padding-left: 2%;
            margin-bottom: 2%;
        }
        .related-posts ul {
            list-style-type: none !important;
            margin: 0;
            padding: 0;
        }
        .related-posts li {
            margin: 0 0 10px 0;
            padding: 0;
            list-style-type: none !important;
            line-height: 2 !important;
        }
        .related-posts a {
            font-size: 1.1em;
            text-decoration: none !important;
            color: #0073aa;
        }
        .related-posts a:hover{
            background: #eaeaea;
            color: #000;
            padding: 1%;
            font-weight: bold;
        }
    </style>
    <?php
}
// El estilo se añade a la cabeza del documento mediante la acción "wp_head"
add_action('wp_head', 'related_posts_styles');