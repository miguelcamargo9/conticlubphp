<?php

namespace App\Http\Controllers\API;

// Models
use App\User;
use DB;

class ReportController
{
    public function invoicesByUsers()
    {
        $users = User::select(['id', 'name','points','subsidiary_id'])
            ->withCount("invoices")
            ->with("subsidiary.city")
            ->where("subsidiary_id", "!=", "null")
            ->get();


        foreach ($users as $user) {
            $invByUser = "SELECT id FROM points WHERE invoice_id IN
                            (SELECT id FROM invoice WHERE users_id = $user->id)";
            $movByInv = "SELECT points_movements_id FROM points_movements_detail WHERE points_id IN ($invByUser)";
            $movPointsRes = "SELECT SUM(points) as gastados FROM points_movements
                               WHERE id IN ($movByInv) AND type_movement='res'";
            $movPointsExp = "SELECT SUM(points) as vencidos FROM points_movements
                               WHERE id IN ($movByInv) AND type_movement='exp'";
            $applies = "SELECT state,COUNT(id) as total FROM `change_points`
                                WHERE `users_id`= $user->id GROUP by `state`";

            $rSpent = DB::select($movPointsRes);
            $rExpired = DB::select($movPointsExp);
            $rApplied = DB::select($applies);

            foreach ($rApplied as $ap) {
                $pos = "apply_{$ap->state}";
                $user->$pos = $ap->total;
            }

            $user->gastados = $rSpent[0]->gastados;
            $user->vencidos = $rExpired[0]->vencidos;
        }
        return $users;
    }
}
