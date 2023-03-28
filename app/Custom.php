<?php 

namespace App;

use App\Models\ClubManager;
use App\Models\MatchDetails;
use App\Models\PlayerCategory;
use App\Models\Team;
use App\Models\User;

class Custom{ 

   public static function categoryName($id){
      $category = PlayerCategory::where('category_id', '=', $id)->first();
      return $category->category_name;
   }

   public static function playerCategoryName($id){
    $user = User::where('id', '=', $id)->first();
    $category = PlayerCategory::where('category_id', '=', $user->user_categoryID)->first();
    return $category->category_name;
 }
 public static function status($status){
  if($status == 'A'){
    return 'Active';
  }elseif($status == 'B'){
    return 'Block';
  }elseif($status == 'AP'){
    return 'Admin Approval';
  }elseif($status == 'R'){
    return 'Rejected';
  }elseif($status == 'C'){
    return 'Cencel';
  }elseif($status == 'P'){
    return 'Pending';
  }else{
    return 'N/A';
  }
}

    public static function userName($id){
      $user = User::where('id', '=', $id)->first();
      return $user->name;
    }

    public static function clubName($id){
      $user = ClubManager::where('id', '=', $id)->first();
      return $user->name;
    }

    public static function teamName($id){
      $team = Team::where('team_id', '=', $id)->first();
      return $team->team_name;
    }

    public static function eventType($type){
       if($type == 'E'){
        return 'Event';
       }elseif($type == 'N'){
        return 'News';
       }else{
        return 'N/A';
       }
    }

    public static function playerExist($playerid, $matchid){
       $details = MatchDetails::where('match_detail_matchID', '=', $matchid)->where('match_detail_playerID', '=', $playerid)->first();
       if($details){
        return true;
       }else{
        return false;
       }
    } 




   public static function slug($text, string $divider = '-')
   {
     // replace non letter or digits by divider
     $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
   
     // transliterate
     $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
   
     // remove unwanted characters
     $text = preg_replace('~[^-\w]+~', '', $text);
   
     // trim
     $text = trim($text, $divider);
   
     // remove duplicate divider
     $text = preg_replace('~-+~', $divider, $text);
   
     // lowercase
     $text = strtolower($text);
   
     if (empty($text)) {
       return 'n-a';
     }
   
     return $text;
   }


    }




?>