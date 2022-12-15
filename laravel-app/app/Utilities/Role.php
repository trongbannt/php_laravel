<?php
  
namespace App\Utilities;
 
enum Role:int {
    case Administrator = 1;
    case Creator = 2;
    case Editor = 3;
    case Deleter = 4;
    case View = 5;
    
}