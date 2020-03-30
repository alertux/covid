<?php

return [
    'menu' => [
        'M' => [
            'dashboard' => [
                'title' => 'Dashboard',
                'icon' => 'fa-home'
            ],
            'INVENTORIO' =>[
                'title' => 'Inventory',
                'icon' => 'fa-briefcase',
                'children' =>[
                    'category.index' => [
                        'title' => 'Category',
                        'icon' => 'icon-plane'
                    ],
                    'product.index' => [
                        'title' => 'Product',
                        'icon' => 'icon-briefcase'
                    ],
                    'customer.index' => [
                        'title' => 'Customer',
                        'icon' => 'icon-briefcase'
                    ]
                ]
            ],
            'FACTURACION' =>[
                'title' => 'Invoice',
                'icon' => 'fa-plane',
                'children' =>[
                    'tax.index' => [
                        'title' => 'COMP. DE CREDITO',
                        'icon' => 'icon-plane'
                    ],
                    'invoice.index' => [
                        'title' => 'FACTURA',
                        'icon' => 'icon-notebook',
                    ],
                    'credit.index' => [
                        'title' => 'NOTA DE CREDITO',
                        'icon' => 'icon-credit-card',
                    ],
                    'transport.index' => [
                        'title' => 'FACTURA DE EXP.',
                        'icon' => 'icon-plane',
                    ]
                ]
            ],
            'users.index' => [
                'title' => 'User',
                'icon' => 'fa-user'
            ]
		],
        'T' => [
            'dashboard' => [
                'title' => 'Home Page',
                'icon' => 'icon-home',
            ],
            'prealert.index' => [
                'title' => 'PRE-ALERTAS (SEND)',
                'icon' => 'icon-notebook'
            ],
            'validation.index' => [
                'title' => 'VALIDACION (OPEN)',
                'icon' => 'icon-credit-card'
            ],
            'INVENTORIO' =>[
                'title' => 'INVENTORIO',
                'icon' => 'icon-briefcase',
                'children' =>[
                    'category.index' => [
                        'title' => 'CATEGORIA',
                        'icon' => 'icon-plane'
                    ],
                    'product.index' => [
                        'title' => 'PRODUCTO',
                        'icon' => 'icon-briefcase'
                    ],
                    'customer.index' => [
                        'title' => 'CLIENTE',
                        'icon' => 'icon-briefcase'
                    ]
                ]
            ],
            'FACTURACION' =>[
                'title' => 'FACTURACION',
                'icon' => 'icon-plane',
                'children' =>[
                    'tax.index' => [
                        'title' => 'COMP. DE CREDITO',
                        'icon' => 'icon-plane'
                    ],
                    'invoice.index' => [
                        'title' => 'FACTURA',
                        'icon' => 'icon-notebook',
                    ],
                    'credit.index' => [
                        'title' => 'NOTA DE CREDITO',
                        'icon' => 'icon-credit-card',
                    ],
                    'transport.index' => [
                        'title' => 'FACTURA DE EXP.',
                        'icon' => 'icon-plane',
                    ]
                ]
            ]

        ]
    ]
];
