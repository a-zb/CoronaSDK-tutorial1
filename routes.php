<?php

// Index home page and a test page for viewing the scores
$app->get('/', function(){
	echo "My Game - home <br/>";
	echo "Text database <a href='/index.php/testdb/'>Test database</a><br/>";
	echo "Save score for user 1 <a href='/index.php/savescore/?id=1&game=3&score=100'>save</a><br/>";
	echo "Save score for user 2 <a href='/index.php/savescore/?id=2&game=3&score=100'>save</a><br/>";
});

$app->get('/testdb/', function() use ($app){
	echo "Doctrine library path: ".Doctrine::getPath()."<br/>";
	echo "Tables: "; print_r($app->dbcon->execute("SHOW TABLES")->fetchAll()); echo "<br/>";

	echo "Users: <br/>";
	$users = Doctrine_Core::getTable('User')->findAll();
	foreach($users as $user){
		echo $user->id. " " .$user->name." <br/>";
		if( count($user->Scores) ){
			echo "<ul>";
			foreach($user->Scores as $score){
				echo "<li>" . $score->score . " in game id " . $score->game_id ." name: ". $score->Game->name ."</li><br/>";
			}
			echo "</ul>";
		}
	}
});


// API or remote functions for saving data
$app->map('/savescore/', function() use($app){
	if ($app->request()->isGet()) {
		$params = $app->request()->get();
	}
	elseif ($app->request()->isPost()){
		$params = $app->request()->post();
	}
	else{ echo json_encode(array( 'status'=>'method error'));}

	try{
		saveScore($params);
		echo json_encode($params);
	}catch(Exception $e){
		echo json_encode(array('status'=>$e->getMessage()));
	}
})->via('GET', 'POST');


function saveScore($params){
	$score = new Score();
	$score->user_id = $params['id'];
	$score->game_id = $params['game'];
	$score->score = $params['score'];
	$score->save();
}