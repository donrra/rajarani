<?php

/*
 * DateTimeConversionBehavior
 * Automatically converts date and datetime fields between formats
 * Based on DateTimeI18NBehavior from Ricardo Grana <rickgrana@yahoo.com.br>, <ricardo.grana@pmm.am.gov.br>
 * Author: Cassiano Surek <cass@surek.co.uk>
 * Version: 1.0
 * Requires: Yii 1.0.9 version
 */

class DateTimeConversionBehavior  extends CActiveRecordBehavior
{
	public $dateOutFormat = 'dd-MM-yyyy';
	public $dateTimeOutFormat = 'dd-MM-yyyy hh:mm';

	public $dateInFormat = 'yyyy-MM-dd';
	public $dateTimeInFormat = 'yyyy-MM-dd hh:mm:ss';
	
	public function beforeSave($event){
		
		//search for date/datetime columns. Convert it to pure PHP date format
		foreach($event->sender->tableSchema->columns as $columnName => $column){
			if ( ($column->dbType != 'date') and ($column->dbType != 'datetime') and ($column->dbType != 'timestamp') ) continue;

			if (!strlen($event->sender->$columnName)){
				$event->sender->$columnName = null;
				continue;
			}

			if (($column->dbType == 'date')) {
				$event->sender->$columnName = date("Y-m-d", CDateTimeParser::parse($event->sender->$columnName, "dd-MM-yyyy"));
			}else{
				
				$event->sender->$columnName=$event->sender->$columnName;
				$event->sender->$columnName = date("Y-m-d H:i:s", CDateTimeParser::parse($event->sender->$columnName, "dd-MM-yyyy hh:mm:ss"));
			}

		}

		return true;
	}

	public function afterFind($event){

		foreach($event->sender->tableSchema->columns as $columnName => $column){

			if (($column->dbType != 'date') and ($column->dbType != 'datetime') and ($column->dbType != 'timestamp')) continue;

			if (!strlen($event->sender->$columnName) || $event->sender->$columnName=="0000-00-00" || $event->sender->$columnName=="0000-00-00 00:00:00"){
				$event->sender->$columnName = null;
				continue;
			}

			if ($column->dbType == 'date'){
				$event->sender->$columnName = Yii::app()->dateFormatter->format($this->dateOutFormat,$event->sender->$columnName);
			}else{
				$event->sender->$columnName = Yii::app()->dateFormatter->format($this->dateTimeOutFormat,$event->sender->$columnName);
			}
		}
		return true;
	}
}