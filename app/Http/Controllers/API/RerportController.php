<?php

namespace App\Http\Controllers\API;


Use App\Invoice;
Use App\User;

class RerportController {
  
  function invoicesByUsers() {
    $users = User::select(['id', 'name','points','subsidiary_id'])->withCount("invoices")->with("subsidiary.city")->where("subsidiary_id","!=","null")->get();
    foreach ($users as $num=>$user) {
      $invByUser = "SELECT id FROM points WHERE invoice_id IN (SELECT id FROM invoice WHERE users_id = $user->id)";
      $movByInv = "SELECT points_movements_id FROM points_moviments_detail WHERE points_id IN ($invByUser)";
      $movPointsRes = "SELECT SUM(points) as gastados FROM points_movements WHERE id IN ($movByInv) AND type_movement='res'";  
      $movPointsExp = "SELECT SUM(points) as vencidos FROM points_movements WHERE id IN ($movByInv) AND type_movement='exp'";  
      
      $applys = "SELECT state,COUNT(id) as total FROM `change_points` WHERE `users_id`= $user->id GROUP by `state`";
      
      
      $rGstados = \DB::select($movPointsRes);
      $rVencidos = \DB::select($movPointsExp);
      $rApplys = \DB::select($applys);
      
    
    
      foreach ($rApplys as $ap) {
        $pos = "apply_{$ap->state}";
        $users[$num]->$pos = $ap->total;
      }
      
      $users[$num]->gastados = $rGstados[0]->gastados;
      $users[$num]->vencidos = $rVencidos[0]->vencidos;
      
    }
    return $users;
  }
  
}
