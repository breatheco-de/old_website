<?php

class PokerCalendarType{
    
    function __construct(){
    
	    $csvURL = 'hello.csv';
	    $forceUpdate = true; //si queremos actualizar incluso cuando ya el badge fue creado anteriormente
	    $jsonURL = $this->csvToJSON($post_ID,$csvURL,$forceUpdate);
	    // re-hook this function
	    add_action( 'save_post_'.self::POST_TYPE, array($this,'slug_save_post_callback'), 10, 3 );
	}
	
	function csvToJSON($post_ID,$url,$forceUpdate = false)
	{
		
		try{
			if(empty($url)) throw new Exception('The calendar has no new CSV file to upload');
			
			$array = array_map('str_getcsv', file($url));
			if(!$array) throw new Exception('The CSV has invalid caracters or format');
			//I have to make sure that the CSV will be encoded successfully later
			$result = json_encode($array);
			if(!$result) throw new Exception('The CSV has invalid caracters or format');
			
			//Create the tournaments posts into wordpress
			if($this->validateBadges($array)) $badges = $this->createBadges($array, $forceUpdate);
			
			//Encode into a json and save it in the uploads folder
			$jsonURL = $this->saveJSON($badges);
		}
		catch(Exception $e)
		{
			BCNotification::addTransientMessage(BCNotification::ERROR,$e->getMessage());
		}
		
		return $tournaments;
	}
	
	function saveJSON($post_ID,$data){
		$upload = wp_upload_dir();
		$uploadPath = $upload['basedir'].'/static/poker-calendar-'.$post_ID.'.json';
		$fp = fopen($uploadPath, 'w+');
		if($fp)
		{
			$result = fwrite($fp, json_encode($data));
			fclose($fp);
			if(!$result) throw new Exception('Could not write on the calendar.json file');
			
			return $uploadPath;
		}
		else throw new Exception('Could not open or create the calendar.json file');
	}
	
	function validateBadges($tournaments){

		$errors = [];
		
		if(!$tournaments or count($tournaments)==0) $errors[] = 'No tournaments found in the CSV or the format was incorrect';
		if($tournaments[0] and !isset($tournaments[0][12])) $errors[] = 'The CSV needs to have 13 columns exactly';
		
		if(count($errors))
		{
			for($i=0;$i<count($tournaments);$i++)
			{
				if($i==0) continue;//it's the header of the CSV table
				
				$t = $tournaments[$i];
				
				//at least the tournament ID of the h1 needs to have a value
				if(empty($t[10]) and empty($t[11])) $errors[] = "The row $i has no tournament_id and no h1 either";
				
				//If there is a tournament ID we are going to try to re-use the same from the DB
				if(!empty($t[10]) and is_numeric($t[10])){
					
					//If the tournament is not in our database
					if(!get_post($t[10])) $errors[] = "The tournament_id in the row $i was not found in the Database.";
					//if it is, then we skip this update
					else continue;
				}//it means that the tournament is already created, it is goign to be re-used form a past tournament
				
				if(empty($t[11])) $errors[] = "The h1 in the row $i is empty";
				else
				{
					$post = get_page_by_title($t[11], OBJECT, 'tournament');
					if($post) $errors[] = "A tournament with the same h1 as the one in row $i was found in the Database. You should set that tournament_id";
				}
				
			}
		}
		
		if(count($errors)>20) throw new Exception('More than 20 errors where found in the calendar, here is a few: '.$this->arrayToHTML($errors));
		if(count($errors)>0) throw new Exception('The calendar was not imported because the following erros have been found: '.$this->arrayToHTML($errors));
		
		return true;
	}
	
	private function arrayToHTML($array){
		$content = '<ul>';
		$i = 0;
		while($i < count($array) and $i < 20) 
		{
			$content .= '<li>'.$array[$i].'</li>';
			$i++;
		}
		$content .= '</ul>';
		
		return $content;
	}
	
	function createBadges($badges, $forceUpdate = false){
		
		$changes = [];
		$changes['updated'] = 0;
		$changes['created'] = 0;
		$changes['ignored'] = 0;
		$totalBadges = count($badges);
		
		for($i=0;$i<$totalBadges;$i++)
		{
		    
			if($i==0) continue;//jump the first line, it's the header of the CSV table
			$badgeRow = $badges[$i];
			
			$badgeArray['profile_slug']	    = $badgeRow[0];
			$badgeArray['specialty_slug']	= $badgeRow[1];
			$badgeArray['badge_slug']	    = $badgeRow[2];
			$badgeArray['badge_title']		= $badgeRow[3];
			$badgeArray['badge_points']     = $badgeRow[4];
			$badgeArray['badge_description']= $badgeRow[5];
			
			$oldBadge = Badge::getBy('slug', $badgeArray['badge_slug']);//get the badge from the DB
			if(!$forceUpdate && $oldBadge!=null){//if force=false we don't want to update badges
				$changes['ignored'] += 1;
				continue;
			}
			
			if($oldBadge) 
			{
				$changes['updated'] += 1;
			}
			//if there is not, create it.
			else
			{
			    $oldBadge = new Badge();
			    $oldBadge->slug = $badgeArray['badge_slug'];
				$changes['created'] += 1;
			}

			$oldBadge->title = $badgeArray['badge_title'];
			$oldBadge->points = $badgeArray['badge_points'];
			$oldBadge->description = $badgeArray['badge_description'];
			$oldBadge->save();
			
		}
		
		$totalBadges--;
		$log = [];
		$log[] = $changes['ignored'].' out of '.$totalBadges.' posts where ignored (because they had known ID).';
		$log[] = $changes['created'].' out of '.$totalBadges.' posts where created (because they had uknown ID and uknown H1).';
		
		if($forceUpdate) $updateReason = ' because the updated options was enforced';
		else $updateReason = 'because they had uknown ID but known H1';
		$log[] = $changes['updated'].' out of '.$totalBadges.' posts where updated ('.$updateReason.').';
		
		return $badges;
	}
	