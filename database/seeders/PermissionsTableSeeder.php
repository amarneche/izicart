<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'product_create',
            ],
            [
                'id'    => 18,
                'title' => 'product_edit',
            ],
            [
                'id'    => 19,
                'title' => 'product_show',
            ],
            [
                'id'    => 20,
                'title' => 'product_delete',
            ],
            [
                'id'    => 21,
                'title' => 'product_access',
            ],
            [
                'id'    => 22,
                'title' => 'color_attribute_create',
            ],
            [
                'id'    => 23,
                'title' => 'color_attribute_edit',
            ],
            [
                'id'    => 24,
                'title' => 'color_attribute_show',
            ],
            [
                'id'    => 25,
                'title' => 'color_attribute_delete',
            ],
            [
                'id'    => 26,
                'title' => 'color_attribute_access',
            ],
            [
                'id'    => 27,
                'title' => 'size_attribute_create',
            ],
            [
                'id'    => 28,
                'title' => 'size_attribute_edit',
            ],
            [
                'id'    => 29,
                'title' => 'size_attribute_show',
            ],
            [
                'id'    => 30,
                'title' => 'size_attribute_delete',
            ],
            [
                'id'    => 31,
                'title' => 'size_attribute_access',
            ],
            [
                'id'    => 32,
                'title' => 'variation_attribute_create',
            ],
            [
                'id'    => 33,
                'title' => 'variation_attribute_edit',
            ],
            [
                'id'    => 34,
                'title' => 'variation_attribute_show',
            ],
            [
                'id'    => 35,
                'title' => 'variation_attribute_delete',
            ],
            [
                'id'    => 36,
                'title' => 'variation_attribute_access',
            ],
            [
                'id'    => 37,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 38,
                'title' => 'category_create',
            ],
            [
                'id'    => 39,
                'title' => 'category_edit',
            ],
            [
                'id'    => 40,
                'title' => 'category_show',
            ],
            [
                'id'    => 41,
                'title' => 'category_delete',
            ],
            [
                'id'    => 42,
                'title' => 'category_access',
            ],
            [
                'id'    => 43,
                'title' => 'store_setting_access',
            ],
            [
                'id'    => 44,
                'title' => 'delivery_access',
            ],
            [
                'id'    => 45,
                'title' => 'wilaya_create',
            ],
            [
                'id'    => 46,
                'title' => 'wilaya_edit',
            ],
            [
                'id'    => 47,
                'title' => 'wilaya_show',
            ],
            [
                'id'    => 48,
                'title' => 'wilaya_delete',
            ],
            [
                'id'    => 49,
                'title' => 'wilaya_access',
            ],
            [
                'id'    => 50,
                'title' => 'commune_create',
            ],
            [
                'id'    => 51,
                'title' => 'commune_edit',
            ],
            [
                'id'    => 52,
                'title' => 'commune_show',
            ],
            [
                'id'    => 53,
                'title' => 'commune_delete',
            ],
            [
                'id'    => 54,
                'title' => 'commune_access',
            ],
            [
                'id'    => 55,
                'title' => 'delivery_company_create',
            ],
            [
                'id'    => 56,
                'title' => 'delivery_company_edit',
            ],
            [
                'id'    => 57,
                'title' => 'delivery_company_show',
            ],
            [
                'id'    => 58,
                'title' => 'delivery_company_delete',
            ],
            [
                'id'    => 59,
                'title' => 'delivery_company_access',
            ],
            [
                'id'    => 60,
                'title' => 'payment_method_create',
            ],
            [
                'id'    => 61,
                'title' => 'payment_method_edit',
            ],
            [
                'id'    => 62,
                'title' => 'payment_method_show',
            ],
            [
                'id'    => 63,
                'title' => 'payment_method_delete',
            ],
            [
                'id'    => 64,
                'title' => 'payment_method_access',
            ],
            [
                'id'    => 65,
                'title' => 'sales_management_access',
            ],
            [
                'id'    => 66,
                'title' => 'customer_create',
            ],
            [
                'id'    => 67,
                'title' => 'customer_edit',
            ],
            [
                'id'    => 68,
                'title' => 'customer_show',
            ],
            [
                'id'    => 69,
                'title' => 'customer_delete',
            ],
            [
                'id'    => 70,
                'title' => 'customer_access',
            ],
            [
                'id'    => 71,
                'title' => 'order_create',
            ],
            [
                'id'    => 72,
                'title' => 'order_edit',
            ],
            [
                'id'    => 73,
                'title' => 'order_show',
            ],
            [
                'id'    => 74,
                'title' => 'order_delete',
            ],
            [
                'id'    => 75,
                'title' => 'order_access',
            ],
            [
                'id'    => 76,
                'title' => 'marketing_access',
            ],
            [
                'id'    => 77,
                'title' => 'coupon_create',
            ],
            [
                'id'    => 78,
                'title' => 'coupon_edit',
            ],
            [
                'id'    => 79,
                'title' => 'coupon_show',
            ],
            [
                'id'    => 80,
                'title' => 'coupon_delete',
            ],
            [
                'id'    => 81,
                'title' => 'coupon_access',
            ],
            [
                'id'    => 82,
                'title' => 'order_item_create',
            ],
            [
                'id'    => 83,
                'title' => 'order_item_edit',
            ],
            [
                'id'    => 84,
                'title' => 'order_item_show',
            ],
            [
                'id'    => 85,
                'title' => 'order_item_delete',
            ],
            [
                'id'    => 86,
                'title' => 'order_item_access',
            ],
            [
                'id'    => 87,
                'title' => 'cart_create',
            ],
            [
                'id'    => 88,
                'title' => 'cart_edit',
            ],
            [
                'id'    => 89,
                'title' => 'cart_show',
            ],
            [
                'id'    => 90,
                'title' => 'cart_delete',
            ],
            [
                'id'    => 91,
                'title' => 'cart_access',
            ],
            [
                'id'    => 92,
                'title' => 'cart_item_create',
            ],
            [
                'id'    => 93,
                'title' => 'cart_item_edit',
            ],
            [
                'id'    => 94,
                'title' => 'cart_item_show',
            ],
            [
                'id'    => 95,
                'title' => 'cart_item_delete',
            ],
            [
                'id'    => 96,
                'title' => 'cart_item_access',
            ],
            [
                'id'    => 97,
                'title' => 'appearence_access',
            ],
            [
                'id'    => 98,
                'title' => 'page_create',
            ],
            [
                'id'    => 99,
                'title' => 'page_edit',
            ],
            [
                'id'    => 100,
                'title' => 'page_show',
            ],
            [
                'id'    => 101,
                'title' => 'page_delete',
            ],
            [
                'id'    => 102,
                'title' => 'page_access',
            ],
            [
                'id'    => 103,
                'title' => 'menu_create',
            ],
            [
                'id'    => 104,
                'title' => 'menu_edit',
            ],
            [
                'id'    => 105,
                'title' => 'menu_show',
            ],
            [
                'id'    => 106,
                'title' => 'menu_delete',
            ],
            [
                'id'    => 107,
                'title' => 'menu_access',
            ],
            [
                'id'    => 108,
                'title' => 'menu_item_create',
            ],
            [
                'id'    => 109,
                'title' => 'menu_item_edit',
            ],
            [
                'id'    => 110,
                'title' => 'menu_item_show',
            ],
            [
                'id'    => 111,
                'title' => 'menu_item_delete',
            ],
            [
                'id'    => 112,
                'title' => 'menu_item_access',
            ],
            [
                'id'    => 113,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 114,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 115,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 116,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 117,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 118,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 119,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 120,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 121,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 122,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 123,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 124,
                'title' => 'task_create',
            ],
            [
                'id'    => 125,
                'title' => 'task_edit',
            ],
            [
                'id'    => 126,
                'title' => 'task_show',
            ],
            [
                'id'    => 127,
                'title' => 'task_delete',
            ],
            [
                'id'    => 128,
                'title' => 'task_access',
            ],
            [
                'id'    => 129,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 130,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 131,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 132,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 133,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 134,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 135,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 136,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 137,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 138,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 139,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 140,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 141,
                'title' => 'expense_create',
            ],
            [
                'id'    => 142,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 143,
                'title' => 'expense_show',
            ],
            [
                'id'    => 144,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 145,
                'title' => 'expense_access',
            ],
            [
                'id'    => 146,
                'title' => 'income_create',
            ],
            [
                'id'    => 147,
                'title' => 'income_edit',
            ],
            [
                'id'    => 148,
                'title' => 'income_show',
            ],
            [
                'id'    => 149,
                'title' => 'income_delete',
            ],
            [
                'id'    => 150,
                'title' => 'income_access',
            ],
            [
                'id'    => 151,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 152,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 153,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 154,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 155,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 156,
                'title' => 'facebook_setting_create',
            ],
            [
                'id'    => 157,
                'title' => 'facebook_setting_edit',
            ],
            [
                'id'    => 158,
                'title' => 'facebook_setting_show',
            ],
            [
                'id'    => 159,
                'title' => 'facebook_setting_delete',
            ],
            [
                'id'    => 160,
                'title' => 'facebook_setting_access',
            ],
            [
                'id'    => 161,
                'title' => 'visual_identity_create',
            ],
            [
                'id'    => 162,
                'title' => 'visual_identity_edit',
            ],
            [
                'id'    => 163,
                'title' => 'visual_identity_show',
            ],
            [
                'id'    => 164,
                'title' => 'visual_identity_delete',
            ],
            [
                'id'    => 165,
                'title' => 'visual_identity_access',
            ],
            [
                'id'    => 166,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
