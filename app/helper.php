<?php

function status($status){
   if($status == "1"){
    return 'Active';
   }else if($status == "0"){
    return 'Inactive';
   }else{
    return 'N/A';
   }
}

function car_condition($condition){
  if($condition == "N"){
   return 'New';
  }else if($condition == "O"){
   return 'Old';
  }else{
   return 'N/A';
  }
}

 function categoryName($category){
    if($category == 'R'){
      return 'Rent';
    }else if($category == 'S'){
      return 'Sell';
    }else if($category == 'B'){
      return 'Buy';
    }else{
      return 'N/A';
    }
}
?>