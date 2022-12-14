<?php
  
namespace App\Utilities;
 
enum Role:int {
    case Administrator = 1;
    case Staff = 4;
    case Guest = 5;
    
}