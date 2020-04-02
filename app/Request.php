<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    public function getStatus(){
    
        $status = $this->status;
        switch ($status) {
            case 0:
                return "Не просмотрено";
            case 1:
                return "Просмотрено";  
            case 2:
                return "Принято к исполнению";  
            case 3:
                return "Закрыто";  
        }
    }

}
