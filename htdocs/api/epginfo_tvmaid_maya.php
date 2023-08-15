<?php
class MayaEpg{
	public static array $data = [];

	static function getEpgDataFromMayaDb(){
		$sqlTimeStampStr = (time() + 62135629200) . '0000000';

		$PDO = new PDO('sqlite:../../TvMaid30/TvmaidMAYA/user/tvmaid-5.db');
		$stmt = $PDO->prepare("select service.fsid, name, title, desc, start, end, duration from service 
								left join (
								select id, fsid, title, desc, start, end, duration from event 
								where start < ? and end > ?)
								as _event on service.fsid = _event.fsid 
								where driver = (select driver from tuner where name = 'siano') order by service.id"
		);
		$stmt->execute([$sqlTimeStampStr, $sqlTimeStampStr]);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	static function fetchEpgData(){
		self::$data = self::getEpgDataFromMayaDb();
	}

	public static function getEpgData(){
		if(!self::$data){
			self::fetchEpgData();
		}

		return self::$data;
	}

	public static function getTimeFromMayaTime($mayaTime){
		return intval($mayaTime) / 10000000 - 62135629200;
	}
}
