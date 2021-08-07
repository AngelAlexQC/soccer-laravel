<?php

use Illuminate\Database\Migrations\Migration;

class AddApprovalFields extends Migration
{
    public function up()
    {
        App\Models\User::all()->each(function (App\Models\User $user) {
            $user->update([
                'approved' => true,
            ]);
        });
    }
}
