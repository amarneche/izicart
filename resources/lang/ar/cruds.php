<?php

return [
    'userManagement' => [
        'title'          => 'إدارة المستخدمين',
        'title_singular' => 'إدارة المستخدمين',
    ],
    'permission' => [
        'title'          => 'الصلاحيات',
        'title_singular' => 'الصلاحية',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'المجموعات',
        'title_singular' => 'مجموعة',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'المستخدمين',
        'title_singular' => 'مستخدم',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'product' => [
        'title'          => 'Product',
        'title_singular' => 'Product',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'slug'                     => 'Slug',
            'slug_helper'              => ' ',
            'title'                    => 'Title',
            'title_helper'             => ' ',
            'price'                    => 'Price',
            'price_helper'             => ' ',
            'sale_price'               => 'Sale Price',
            'sale_price_helper'        => ' ',
            'stock_quantity'           => 'Stock Quantity',
            'stock_quantity_helper'    => ' ',
            'featured_image'           => 'Featured Image',
            'featured_image_helper'    => ' ',
            'gallery'                  => 'Gallery',
            'gallery_helper'           => ' ',
            'short_description'        => 'Short Description',
            'short_description_helper' => ' ',
            'description'              => 'Description',
            'description_helper'       => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'colors'                   => 'Colors',
            'colors_helper'            => ' ',
            'sizes'                    => 'Sizes',
            'sizes_helper'             => ' ',
            'variations'               => 'Variations',
            'variations_helper'        => ' ',
            'status'                   => 'Status',
            'status_helper'            => ' ',
            'category'                 => 'Categories',
            'category_helper'          => ' ',
            'coupon'                   => 'Coupons',
            'coupon_helper'            => ' ',
        ],
    ],
    'colorAttribute' => [
        'title'          => 'Color Attribute',
        'title_singular' => 'Color Attribute',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'value'             => 'Value',
            'value_helper'      => ' ',
            'hex_code'          => 'Hex Code',
            'hex_code_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'sizeAttribute' => [
        'title'          => 'Size Attribute',
        'title_singular' => 'Size Attribute',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'value'             => 'Value',
            'value_helper'      => ' ',
            'image'             => 'Image',
            'image_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'variationAttribute' => [
        'title'          => 'Variation Attribute',
        'title_singular' => 'Variation Attribute',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'value'             => 'Value',
            'value_helper'      => ' ',
            'image'             => 'Image',
            'image_helper'      => ' ',
            'gallery'           => 'Gallery',
            'gallery_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'productManagement' => [
        'title'          => 'Product Management',
        'title_singular' => 'Product Management',
    ],
    'category' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'image'              => 'Image',
            'image_helper'       => ' ',
            'slug'               => 'Lien',
            'slug_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'storeSetting' => [
        'title'          => 'Store Setting',
        'title_singular' => 'Store Setting',
    ],
    'delivery' => [
        'title'          => 'Delivery',
        'title_singular' => 'Delivery',
    ],
    'wilaya' => [
        'title'          => 'Wilaya',
        'title_singular' => 'Wilaya',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'wilaya'                 => 'Wilaya',
            'wilaya_helper'          => ' ',
            'is_available'           => 'Is Available',
            'is_available_helper'    => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'default_cost'           => 'Default Cost',
            'default_cost_helper'    => ' ',
            'payment_methods'        => 'Payment Methods',
            'payment_methods_helper' => ' ',
            'wilaya_ar'              => 'Wilaya in arabic',
            'wilaya_ar_helper'       => ' ',
        ],
    ],
    'commune' => [
        'title'          => 'Commune',
        'title_singular' => 'Commune',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'wilaya'               => 'Wilaya',
            'wilaya_helper'        => ' ',
            'is_available'         => 'Is Available',
            'is_available_helper'  => ' ',
            'delivery_cost'        => 'Delivery Cost',
            'delivery_cost_helper' => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'commune'              => 'Commune',
            'commune_helper'       => ' ',
            'commune_ar'           => 'Commune in Arabic',
            'commune_ar_helper'    => ' ',
        ],
    ],
    'deliveryCompany' => [
        'title'          => 'Delivery Companies',
        'title_singular' => 'Delivery Company',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'company_name'           => 'Company Name',
            'company_name_helper'    => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'logo'                   => 'Logo',
            'logo_helper'            => ' ',
            'phone'                  => 'Phone',
            'phone_helper'           => ' ',
            'email'                  => 'Email',
            'email_helper'           => ' ',
            'adresse'                => 'Adresse',
            'adresse_helper'         => ' ',
            'ship_to_wilayas'        => 'Ship To Wilayas',
            'ship_to_wilayas_helper' => ' ',
        ],
    ],
    'paymentMethod' => [
        'title'          => 'Payment Methods',
        'title_singular' => 'Payment Method',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => ' ',
            'wilaya'             => 'Wilaya',
            'wilaya_helper'      => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'instruction'        => 'Instruction',
            'instruction_helper' => ' ',
        ],
    ],
    'salesManagement' => [
        'title'          => 'Sales Management',
        'title_singular' => 'Sales Management',
    ],
    'customer' => [
        'title'          => 'Customers',
        'title_singular' => 'Customer',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'first_name'        => 'First Name',
            'first_name_helper' => ' ',
            'last_name'         => 'Last Name',
            'last_name_helper'  => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'phone'             => 'Phone',
            'phone_helper'      => ' ',
            'wilaya'            => 'Wilaya',
            'wilaya_helper'     => ' ',
            'commune'           => 'Commune',
            'commune_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'order' => [
        'title'          => 'Orders',
        'title_singular' => 'Order',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'customer'                => 'Customer',
            'customer_helper'         => ' ',
            'ship_to_wilaya'          => 'Ship To Wilaya',
            'ship_to_wilaya_helper'   => ' ',
            'shipt_to_commune'        => 'Commune',
            'shipt_to_commune_helper' => ' ',
            'shipping_cost'           => 'Shipping Cost',
            'shipping_cost_helper'    => ' ',
            'sub_total'               => 'Sub Total',
            'sub_total_helper'        => ' ',
            'total'                   => 'Total',
            'total_helper'            => ' ',
            'status'                  => 'Status',
            'status_helper'           => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'payment_method'          => 'Payment Method',
            'payment_method_helper'   => ' ',
            'order_number'            => 'Order Number',
            'order_number_helper'     => ' ',
        ],
    ],
    'marketing' => [
        'title'          => 'Marketing',
        'title_singular' => 'Marketing',
    ],
    'coupon' => [
        'title'          => 'Coupons',
        'title_singular' => 'Coupon',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'code'               => 'Code',
            'code_helper'        => ' ',
            'coupon_type'        => 'Coupon Type',
            'coupon_type_helper' => ' ',
            'value'              => 'Value',
            'value_helper'       => ' ',
            'category'           => 'Apply on categories',
            'category_helper'    => ' ',
            'product'            => 'Apply on products',
            'product_helper'     => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'exipre_at'          => 'Exipre At',
            'exipre_at_helper'   => ' ',
        ],
    ],
    'orderItem' => [
        'title'          => 'Order Items',
        'title_singular' => 'Order Item',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'product_title'        => 'Product Title',
            'product_title_helper' => ' ',
            'price'                => 'Price',
            'price_helper'         => ' ',
            'quantity'             => 'Quantity',
            'quantity_helper'      => ' ',
            'product'              => 'Product',
            'product_helper'       => ' ',
            'color'                => 'Color',
            'color_helper'         => ' ',
            'size'                 => 'Size',
            'size_helper'          => ' ',
            'variation'            => 'Variation',
            'variation_helper'     => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'order'                => 'Order',
            'order_helper'         => ' ',
        ],
    ],
    'cart' => [
        'title'          => 'Abandoned Carts',
        'title_singular' => 'Abandoned Cart',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'cart_total'         => 'Cart Total',
            'cart_total_helper'  => ' ',
            'customer'           => 'Customer',
            'customer_helper'    => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'cart_number'        => 'Cart Number',
            'cart_number_helper' => ' ',
        ],
    ],
    'cartItem' => [
        'title'          => 'Cart Items',
        'title_singular' => 'Cart Item',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'cart'                 => 'Cart',
            'cart_helper'          => ' ',
            'product'              => 'Product',
            'product_helper'       => ' ',
            'quanitty'             => 'Quanitty',
            'quanitty_helper'      => ' ',
            'product_price'        => 'Product Price',
            'product_price_helper' => ' ',
            'color'                => 'Color',
            'color_helper'         => ' ',
            'size'                 => 'Size',
            'size_helper'          => ' ',
            'variation'            => 'Variation',
            'variation_helper'     => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
        ],
    ],
    'appearence' => [
        'title'          => 'Appearence',
        'title_singular' => 'Appearence',
    ],
    'page' => [
        'title'          => 'Page',
        'title_singular' => 'Page',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'content'           => 'Content',
            'content_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
        ],
    ],
    'menu' => [
        'title'          => 'Menus',
        'title_singular' => 'Menu',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'placement'         => 'Placement',
            'placement_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'menuItem' => [
        'title'          => 'Menu Items',
        'title_singular' => 'Menu Item',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'menu'              => 'Menu',
            'menu_helper'       => ' ',
            'link'              => 'Link',
            'link_helper'       => ' ',
            'page'              => 'Page',
            'page_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'icon'              => 'Icon',
            'icon_helper'       => ' ',
            'css_class'         => 'Css Classes',
            'css_class_helper'  => ' ',
        ],
    ],
    'taskManagement' => [
        'title'          => 'Task management',
        'title_singular' => 'Task management',
    ],
    'taskStatus' => [
        'title'          => 'Statuses',
        'title_singular' => 'Status',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'taskTag' => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'task' => [
        'title'          => 'Tasks',
        'title_singular' => 'Task',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'tag'                => 'Tags',
            'tag_helper'         => ' ',
            'attachment'         => 'Attachment',
            'attachment_helper'  => ' ',
            'due_date'           => 'Due date',
            'due_date_helper'    => ' ',
            'assigned_to'        => 'Assigned to',
            'assigned_to_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'tasksCalendar' => [
        'title'          => 'Calendar',
        'title_singular' => 'Calendar',
    ],
    'expenseManagement' => [
        'title'          => 'المصاريف',
        'title_singular' => 'المصاريف',
    ],
    'expenseCategory' => [
        'title'          => 'تصنيف النفقات',
        'title_singular' => 'تصنيف المصاريف',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'incomeCategory' => [
        'title'          => 'تصنيفات الإيراد',
        'title_singular' => 'الإيراد حسب التصنيف',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'expense' => [
        'title'          => 'المصروفات',
        'title_singular' => 'المصروف',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'expense_category'        => 'Expense Category',
            'expense_category_helper' => ' ',
            'entry_date'              => 'Entry Date',
            'entry_date_helper'       => ' ',
            'amount'                  => 'Amount',
            'amount_helper'           => ' ',
            'description'             => 'Description',
            'description_helper'      => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated At',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted At',
            'deleted_at_helper'       => ' ',
        ],
    ],
    'income' => [
        'title'          => 'الإيرادات',
        'title_singular' => 'الإيرادات',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'income_category'        => 'Income Category',
            'income_category_helper' => ' ',
            'entry_date'             => 'Entry Date',
            'entry_date_helper'      => ' ',
            'amount'                 => 'Amount',
            'amount_helper'          => ' ',
            'description'            => 'Description',
            'description_helper'     => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated At',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted At',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'expenseReport' => [
        'title'          => 'تقرير شهري',
        'title_singular' => 'تقرير شهري',
        'reports'        => [
            'title'             => 'التقارير',
            'title_singular'    => 'تقرير',
            'incomeReport'      => 'تقرير الإيرادات',
            'incomeByCategory'  => 'الإيراد حسب التصنيف',
            'expenseByCategory' => 'المصروف حسب التصنيف',
            'income'            => 'الإيرادات',
            'expense'           => 'المصروف',
            'profit'            => 'ربح',
        ],
    ],
    'facebookSetting' => [
        'title'          => 'Facebook Setting',
        'title_singular' => 'Facebook Setting',
    ],
    'visualIdentity' => [
        'title'          => 'Visual Identity',
        'title_singular' => 'Visual Identity',
    ],
];