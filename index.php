<?php
require_once __DIR__.'/vendor/autoload.php'; 

$app = new Silex\Application(); 

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views'
));

$app['debug']= true;
$app->get('/{q}', function($q) use($app) { 

  $client = new GuzzleHttp\Client();
  $apikey = getenv('API_DOT_ART_KEY');
 
  $res = $client->get('http://api.art.rmngp.fr/v1/works?api_key='.$apikey .'&aggregates[][name]=authors_citizenship&aggregates[][type]=terms&aggregates[][field]=authors.citizenship&facets[periods]=19e+siècle'.'&q='.$q.'&per_page='.'10' );
 
  $decoded = json_decode($res->getBody());
  $hits = $decoded->hits->hits;
  $works = [];
  $work = [];

  foreach ($hits as $hit){
    $work["image_url"] = $hit->_source->images[0]->urls->large->url;
    $work["title"] = $hit->_source->title->fr;
    $works[]=$work;
  }
  

  return $app["twig"]->render("index.twig", array('works' => $works));
});

$app->run(); 
