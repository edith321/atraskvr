<?php

use App\Models\VRRoles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ["name" => "Super Admin", "id" => "super-admin"], // Manage everything
            ["name" => "Project Admin", "id" => "project-admin"], // Manage most aspects of the site
            ["name" => "Member", "id" => "member"], // Special user access
            ["name" => "User", "id" => "user"], // Average Joe
        ];

        DB::beginTransaction ();
        try {
            foreach ($roles as $roleData) {
                $role = VRRoles::where ('id', $roleData['id'])->first ();
                if (!$role)
                    VRRoles::create ($roleData);
            }
        } catch (\Exception $e) {
            DB::rollback ();
            throw new Exception($e->getMessage ());
        }
        DB::commit ();
    }
}
