<?php
/**
 * Handle onMissingTranslation event
 */
 $session=new CHttpSession;
 $session->open();

class MissingMessages extends CApplicationComponent
{
	/**
	 * Add missing translations to the source table and 
	 * If we are using a different translation then the original one
	 * Then add the same message to the translation table.
	 */
	public static function load($event)
	{ 
		if($_SESSION["lang"]!='en')
		{
		
		// Load the messages		
		$source = LangSource::model()->find('message=:message AND category=:category', array(':message'=>$event->message, ':category'=>$event->category));
		
		// If we didn't find one then add it
		if( !$source )
		{
			// Add it
			$model = new LangSource;
			
			$model->category = $event->category;
			$model->message = $event->message;
			$model->save();
			
			$lastID = Yii::app()->db->lastInsertID;
		}
		
		if( $event->language != Yii::app()->sourceLanguage )
		{
			// Do the same thing with the messages	
			$translation = Lang::model()->find('language=:language AND translation=:translation', array(':language'=>$event->language, ':translation'=>$event->message));	
		
			// If we didn't find one then add it
			if( !$translation )
			{
				$source = LangSource::model()->find(' BINARY message=:message AND category=:category', array(':message'=>$event->message, ':category'=>$event->category));
				
				// Add it
				$model = new Lang;
				
				$model->id = $source->id;
				$model->language = $event->language;
				$model->translation = $event->message;
				$model->save();
			}
		}
		
	
		}
	}
}