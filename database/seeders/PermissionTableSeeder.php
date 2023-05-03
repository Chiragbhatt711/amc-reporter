<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionArr = [
            [
                'name' => 'permission-list',
                'guard_name' => 'web',
                'order_by' => '1'
            ],
            [
                'name' => 'permission-create',
                'guard_name' => 'web',
                'order_by' => '2'
            ],
            [
                'name' => 'permission-edit',
                'guard_name' => 'web',
                'order_by' => '3'
            ],
            [
                'name' => 'permission-delete',
                'guard_name' => 'web',
                'order_by' => '4'
            ],
            [
                'name' => 'role-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'role',
                'order_by' => '1'
            ],
            [
                'name' => 'role-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'role',
                'order_by' => '2'
            ],
            [
                'name' => 'role-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'role',
                'order_by' => '3'
            ],
            [
                'name' => 'role-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'role',
                'order_by' => '4'
            ],

            [
                'name' => 'user-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'user',
                'order_by' => '1'
            ],
            [
                'name' => 'user-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'user',
                'order_by' => '2'
            ],
            [
                'name' => 'user-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'user',
                'order_by' => '3'
            ],
            [
                'name' => 'user-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'user',
                'order_by' => '4'
            ],

            // contract-type
            [
                'name' => 'contract-type-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'contract-type',
                'order_by' => '1'
            ],
            [
                'name' => 'contract-type-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'contract-type',
                'order_by' => '2'
            ],
            [
                'name' => 'contract-type-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'contract-type',
                'order_by' => '3'
            ],
            [
                'name' => 'contract-type-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'contract-type',
                'order_by' => '4'
            ],

            // manage-party
            [
                'name' => 'manage-party-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'manage-party',
                'order_by' => '1'
            ],
            [
                'name' => 'manage-party-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'manage-party',
                'order_by' => '2'
            ],
            [
                'name' => 'manage-party-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'manage-party',
                'order_by' => '3'
            ],
            [
                'name' => 'manage-party-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'manage-party',
                'order_by' => '4'
            ],

            // manage-amc
            [
                'name' => 'manage-amc-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'manage-amc',
                'order_by' => '1'
            ],
            [
                'name' => 'manage-amc-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'manage-amc',
                'order_by' => '2'
            ],
            [
                'name' => 'manage-amc-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'manage-amc',
                'order_by' => '3'
            ],
            [
                'name' => 'manage-amc-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'manage-amc',
                'order_by' => '4'
            ],

            // manage-receipt
            [
                'name' => 'manage-receipt-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'manage-receipt',
                'order_by' => '1'
            ],
            [
                'name' => 'manage-receipt-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'manage-receipt',
                'order_by' => '2'
            ],
            [
                'name' => 'manage-receipt-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'manage-receipt',
                'order_by' => '3'
            ],
            [
                'name' => 'manage-receipt-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'manage-receipt',
                'order_by' => '4'
            ],

            // manage-tax
            [
                'name' => 'manage-tax-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'manage-tax',
                'order_by' => '1'
            ],
            [
                'name' => 'manage-tax-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'manage-tax',
                'order_by' => '2'
            ],
            [
                'name' => 'manage-tax-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'manage-tax',
                'order_by' => '3'
            ],
            [
                'name' => 'manage-tax-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'manage-tax',
                'order_by' => '4'
            ],

            // amc-expiry-reminder
            [
                'name' => 'amc-expiry-reminder-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'amc-expiry-reminder',
                'order_by' => '1'
            ],
            [
                'name' => 'amc-expiry-reminder-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'amc-expiry-reminder',
                'order_by' => '2'
            ],
            [
                'name' => 'amc-expiry-reminder-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'amc-expiry-reminder',
                'order_by' => '3'
            ],
            [
                'name' => 'amc-expiry-reminder-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'amc-expiry-reminder',
                'order_by' => '4'
            ],

            // party-ledger-summary
            [
                'name' => 'party-ledger-summary-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'party-ledger-summary',
                'order_by' => '1'
            ],
            [
                'name' => 'party-ledger-summary-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'party-ledger-summary',
                'order_by' => '2'
            ],
            [
                'name' => 'party-ledger-summary-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'party-ledger-summary',
                'order_by' => '3'
            ],
            [
                'name' => 'party-ledger-summary-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'party-ledger-summary',
                'order_by' => '4'
            ],

            // party-ledger-details
            [
                'name' => 'party-ledger-details-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'party-ledger-details',
                'order_by' => '1'
            ],
            [
                'name' => 'party-ledger-details-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'party-ledger-details',
                'order_by' => '2'
            ],
            [
                'name' => 'party-ledger-details-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'party-ledger-details',
                'order_by' => '3'
            ],
            [
                'name' => 'party-ledger-details-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'party-ledger-details',
                'order_by' => '4'
            ],

            // payment-pending-report
            [
                'name' => 'payment-pending-report-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'payment-pending-report',
                'order_by' => '1'
            ],
            [
                'name' => 'payment-pending-report-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'payment-pending-report',
                'order_by' => '2'
            ],
            [
                'name' => 'payment-pending-report-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'payment-pending-report',
                'order_by' => '3'
            ],
            [
                'name' => 'payment-pending-report-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'payment-pending-report',
                'order_by' => '4'
            ],

            // service-tax-report
            [
                'name' => 'service-tax-report-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'service-tax-report',
                'order_by' => '1'
            ],
            [
                'name' => 'service-tax-report-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'service-tax-report',
                'order_by' => '2'
            ],
            [
                'name' => 'service-tax-report-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'service-tax-report',
                'order_by' => '3'
            ],
            [
                'name' => 'service-tax-report-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'service-tax-report',
                'order_by' => '4'
            ],

            // manage-complaint-template
            [
                'name' => 'manage-complaint-template-list',
                'guard_name' => 'web',
                'view_name' => 'List',
                'menu_name' => 'manage-complaint-template',
                'order_by' => '1'
            ],
            [
                'name' => 'manage-complaint-template-create',
                'guard_name' => 'web',
                'view_name' => 'Add',
                'menu_name' => 'manage-complaint-template',
                'order_by' => '2'
            ],
            [
                'name' => 'manage-complaint-template-edit',
                'guard_name' => 'web',
                'view_name' => 'Edit',
                'menu_name' => 'manage-complaint-template',
                'order_by' => '3'
            ],
            [
                'name' => 'manage-complaint-template-delete',
                'guard_name' => 'web',
                'view_name' => 'Delete',
                'menu_name' => 'manage-complaint-template',
                'order_by' => '4'
            ],
        ];

        foreach ($permissionArr as $permission)
        {
            $checkExist = Permission::where(['name'=>$permission['name']])->get()->count();
            if($checkExist == 0)
            {
                Permission::create($permission);
            }
            else
            {
                Permission::where(['name'=>$permission['name']])->update($permission);
            }
        }
    }
}
