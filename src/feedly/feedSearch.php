<?php
/**
 * Created by PhpStorm.
 * User: Elías
 * Date: 07/06/2015
 * Time: 14:46
 */

namespace feedly;

add_rss("Artificial Intelligence");

function add_rss($tags)
{

    //https://cloud.feedly.com/v3/search/feeds?query=%22inteligencia%20artificial%22&locale=es_ES
    //https://developer.feedly.com/v3/search/#find-feeds-based-on-title-url-or-topic

    //$url = 'http://cloud.feedly.com/v3/search/feeds';

    /// REST CALL
    //$header = array('Content-Type: text/plain');
    //$serverurl = $domainname . '?query="Artificial Intelligence"&locale=en&count=2';
    //extract data from the post

    //set POST variables
    $fields = array(
        'query' => urlencode("Artificial Intelligence"),
        'locale' => urlencode("en"),
        'count' => urlencode(2)
    );

    //url-ify the data for the POST
    $fields_string = "";
    foreach ($fields as $key => $value) {
        $fields_string .= $key . '=' . $value . '&';
    }
    rtrim($fields_string, '&');

    //open connection
    $ch = curl_init();
    $tag = str_replace (' ', '%20', $tags);
    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://cloud.feedly.com/v3/search/feeds?query='. $tag .'&locale=en&count=2'
    ));

//execute post
    if (!$output = curl_exec($ch))
        echo "Error: ".curl_error($ch);
    else {
        echo "Success";
    }
    //close connection
    curl_close($ch);
    print_r($output);

    $answer_array = json_decode($output, true);
    //print_r($answer_array);
    echo "\n";
    print_r($answer_array['results'][0]['title']);
    echo "\n";
    print_r(implode(',', $answer_array['results'][0]['deliciousTags']));
    echo "\n";
    print_r($answer_array['results'][0]['website']);
    echo "\n";
    print_r($answer_array['results'][0]['description']);

}
