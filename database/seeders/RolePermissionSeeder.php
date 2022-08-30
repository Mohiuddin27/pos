<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create Roles

        $roleAdmin= Role::create(['name' => 'admin']);
        $roleSuperAdmin= Role::create(['name' => 'superadmin']);
        $roleEditor= Role::create(['name' => 'editor']);
        $roleUser= Role::create(['name' => 'user']);


        //Permission as array
        $permissions =[
              [
                'group_name'=>'dashboard',
                'permissions'=>[
                    'dashboard.view',

                ]
              ],
              [
                'group_name'=>'partytype',
                'permissions'=>[
                    'partytype.index',
                    'party.type.create',
                    'partytype.edit',
                    'partytype.update',
                    'partytype.temporary.delete',

                ]
              ],
              [
                'group_name'=>'party',
                'permissions'=>[
                    'party.index',
                    'party.create',
                    'party.view',
                    'party.edit',
                    'party.update',
                    'party.temporary.delete',

                ]
              ],
              [
                'group_name'=>'recycle',
                'permissions'=>[
                    'recycle.bin',
                    'party.trash',
                    'party.restore',
                    'party.permanently.delete',

                ]
              ],
              [
                'group_name'=>'admin',
                'permissions'=>[
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',

                ]
              ],
              [
                'group_name'=>'role',
                'permissions'=>[
                    'role.create',
                    'role.view',
                    'rolw.edit',
                    'role.delete',
                    'role.update',

                ]
              ],

              [
                'group_name'=>'profile',
                'permissions'=>[
                    'profile.view',
                    'profile.edit',

                ]
              ],

            


            


              

             

             

        ];
        //Create and Assign Permissions
        for($i=0;$i<count($permissions);$i++){
            $permissionGroup=$permissions[$i]['group_name'];
            for($j=0;$j<count($permissions[$i]['permissions']);$j++){
              $permission =Permission::create(['name'=>$permissions[$i]['permissions'][$j],'group_name'=> $permissionGroup]);
              $roleSuperAdmin->givePermissionTo($permission);
              $permission->assignRole($roleSuperAdmin);
            }

        }

    }
}
