<?php 

namespace App\Enums;
use App\Traits\EnumValues;


enum OrderStatus: string
{
    use EnumValues;
    
    case REVISION = "revision";
    case RECHAZADO = "rechazado";
    case COLA_PRODUCCION = "cola produccion";
    case PRODUCCION = "produccion";
    case FINALIZADO = "finalizado";
}
