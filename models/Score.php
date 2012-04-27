<?php

class Score extends Doctrine_Record {
	public function setTableDefinition(){
		$this->hasColumn('score', 'integer', null);

		$this->hasColumn('user_id', 'integer', null, array(
	        'primary' => true
	    ));
	    $this->hasColumn('game_id', 'integer', null, array(
	        'primary' => true
	    ));

	}

	public function setUp(){
		$this->hasOne('User',array('local'=>'user_id','foreign'=>'id'));
		$this->hasOne('Game',array('local'=>'game_id','foreign'=>'id'));
	}
}