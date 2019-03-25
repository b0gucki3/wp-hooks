$tags = array();
add_action('all', function ($tag) {
    global $tags;
    if (in_array($tag, $tags)) {
        return;
    }
    $tags[] = $tag;

    $content_org = ob_get_contents();
    $content = preg_replace('/\s+/', '', $content_org);
    $last_char = substr($content, -1);

    if ($last_char == '>') {

        $last = strrchr($content_org, ">");
        $pos = strrpos($content_org, $last);

        echo "<!-- HOOK $tag -->";
    } else {
        $last = strrchr($content_org, "<");
        $pos = strrpos($content_org, $last);

        $first = substr($content_org, 0, $pos);

        ob_clean();
        echo $first . "<!-- HOOK $tag -->" . $last;
    }
});
