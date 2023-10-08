<?php
return [
    'dashboard' => [
        'page_name' => 'Dashboard',
        'breadcums' => [
            ['name' => 'Dashboard', 'url' => ''],
        ],
    ],
    'settings' => [
        'index' => [
            'page_name' => 'Settings',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'Settings', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'Settings',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'Settings', 'url' => 'admin.settings.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'Settings',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'Settings', 'url' => 'admin.settings.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
        'group' => [
            'page_name' => 'Settings',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'Settings', 'url' => 'admin.settings.index'],
                ['name' => '', 'url' => ''],
            ],
        ],
    ],
    'modules' => [
        'index' => [
            'page_name' => 'Modules',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'Modules', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'Modules',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'Modules', 'url' => 'admin.modules.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'Modules',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'Modules', 'url' => 'admin.modules.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'categories' => [
        'index' => [
            'page_name' => 'categories',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'categories', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'categories',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'categories', 'url' => 'admin.categories.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'categories',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'categories', 'url' => 'admin.categories.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'brands' => [
        'index' => [
            'page_name' => 'brands',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'brands', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'brands',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'brands', 'url' => 'admin.brands.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'brands',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'brands', 'url' => 'admin.brands.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'discounts' => [
        'index' => [
            'page_name' => 'discounts',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'discounts', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'discounts',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'discounts', 'url' => 'admin.discounts.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'discounts',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'discounts', 'url' => 'admin.discounts.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'products' => [
        'index' => [
            'page_name' => 'products',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'products', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'products',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'products', 'url' => 'admin.products.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'products',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'products', 'url' => 'admin.products.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'purchases' => [
        'index' => [
            'page_name' => 'purchases',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'purchases', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'purchases',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'purchases', 'url' => 'admin.purchases.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'purchases',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'purchases', 'url' => 'admin.purchases.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'sales' => [
        'index' => [
            'page_name' => 'sales',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'sales', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'sales',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'sales', 'url' => 'admin.sales.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'sales',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'sales', 'url' => 'admin.sales.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'employee' => [
        'index' => [
            'page_name' => 'employee',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'employee', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'employee',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'employee', 'url' => 'admin.employee.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'employee',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'employee', 'url' => 'admin.employee.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'salaries' => [
        'index' => [
            'page_name' => 'salaries',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'salaries', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'salaries',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'salaries', 'url' => 'admin.salaries.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'salaries',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'salaries', 'url' => 'admin.salaries.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'customer' => [
        'index' => [
            'page_name' => 'customer',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'customer', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'customer',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'customer', 'url' => 'admin.customer.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'customer',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'customer', 'url' => 'admin.customer.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'suppliers' => [
        'index' => [
            'page_name' => 'suppliers',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'suppliers', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'suppliers',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'suppliers', 'url' => 'admin.suppliers.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'suppliers',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'suppliers', 'url' => 'admin.suppliers.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'purchase_order_returns' => [
        'index' => [
            'page_name' => 'purchase_order_returns',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'purchase_order_returns', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'purchase_order_returns',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'purchase_order_returns', 'url' => 'admin.purchase_order_returns.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'purchase_order_returns',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'purchase_order_returns', 'url' => 'admin.purchase_order_returns.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'payment_terms' => [
        'index' => [
            'page_name' => 'payment_terms',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'payment_terms', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'payment_terms',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'payment_terms', 'url' => 'admin.payment_terms.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'payment_terms',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'payment_terms', 'url' => 'admin.payment_terms.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'packaging_types' => [
        'index' => [
            'page_name' => 'packaging_types',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'packaging_types', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'packaging_types',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'packaging_types', 'url' => 'admin.packaging_types.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'packaging_types',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'packaging_types', 'url' => 'admin.packaging_types.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'delivery_methods' => [
        'index' => [
            'page_name' => 'delivery_methods',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'delivery_methods', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'delivery_methods',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'delivery_methods', 'url' => 'admin.delivery_methods.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'delivery_methods',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'delivery_methods', 'url' => 'admin.delivery_methods.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'expense_categories' => [
        'index' => [
            'page_name' => 'expense_categories',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'expense_categories', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'expense_categories',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'expense_categories', 'url' => 'admin.expense_categories.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'expense_categories',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'expense_categories', 'url' => 'admin.expense_categories.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'expenses' => [
        'index' => [
            'page_name' => 'expenses',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'expenses', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'expenses',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'expenses', 'url' => 'admin.expenses.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'expenses',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'expenses', 'url' => 'admin.expenses.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'warehouses' => [
        'index' => [
            'page_name' => 'warehouses',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'warehouses', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'warehouses',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'warehouses', 'url' => 'admin.warehouses.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'warehouses',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'warehouses', 'url' => 'admin.warehouses.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'sales_order_returns' => [
        'index' => [
            'page_name' => 'sales_order_returns',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'sales_order_returns', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'sales_order_returns',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'sales_order_returns', 'url' => 'admin.sales_order_returns.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'sales_order_returns',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'sales_order_returns', 'url' => 'admin.sales_order_returns.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
    'transfer_stocks' => [
        'index' => [
            'page_name' => 'transfer_stocks',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'transfer_stocks', 'url' => ''],
            ],
        ],
        'create' => [
            'page_name' => 'transfer_stocks',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'transfer_stocks', 'url' => 'admin.transfer_stocks.index'],
                ['name' => 'Create', 'url' => ''],
            ],
        ],
        'edit' => [
            'page_name' => 'transfer_stocks',
            'breadcums' => [
                ['name' => 'Dashboard', 'url' => 'admin.dashboard'],
                ['name' => 'transfer_stocks', 'url' => 'admin.transfer_stocks.index'],
                ['name' => 'Edit  ', 'url' => ''],
            ],
        ],
    ],
];
