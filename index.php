<?php
require_once __DIR__.'/vendor/autoload.php'; 

$app = new Silex\Application(); 

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views'
));
//on active le debug
$app['debug']= true;

$app->get('/', function() use($app) { 

  $client = new GuzzleHttp\Client();

  $env = json_decode(base64_decode($_ENV['PLATFORM_VARIABLES']));
  $apikey = empty($env->API_DOT_ART_KEY) ? getenv("API_DOT_ART_KEY"): $env->API_DOT_ART_KEY; 
  $q = empty($_GET['oeuvre']) ? "&q=0000" : "&q=".$_GET['oeuvre'];
 //$res = $client->get('http://api.art.rmngp.fr/v1/works?api_key='.$apikey .'&aggregates[][name]=authors_citizenship&aggregates[][type]=terms&aggregates[][field]=authors.citizenship&facets[periods]=19e+siècle'.'&q='.$q.'&per_page='.'100' );
  $res = $client->get('http://api.art.rmngp.fr/v1/works?api_key='.$apikey.$q.'&per_page='.'1'.'&' );
  
  $decoded = json_decode($res->getBody());
  //print_r ($decoded);
  $hits = $decoded->hits->  hits;
  $works = [];
  $work = [];

  foreach ($hits as $hit){
    $work["image_url"] = $hit->_source->images[0]->urls->medium->url;
    $work["title"] = $hit->_source->title->fr;
    $work["authors"] = $hit->_source->authors;
    $works[]=$work;
  }
  

  return $app["twig"]->render("index.twig", array('works' => $works));
});

$app->run(); 
