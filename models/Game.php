<?php

class Game extends Doctrine_Record {
	public function setTableDefinition(){
		$this->hasColumn('name', 'string', 45);
	}

	public function setUp(){
		$this->hasMany(
			'Score as Scores',
			array('local' => 'id', 'foreign' => 'game_id')
		);
	}
}