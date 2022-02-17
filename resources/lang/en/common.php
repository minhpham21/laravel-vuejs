<?php

return [
    'title' => [
        'id' => 'ID',
        'title' => 'Title',
        'active' => 'Active',
        'description' => 'Description',
        'filter' => 'Filter',
        'action' => 'Action',
        'total' => '{0,1}Total: :count entry|[2,*]Total: :count entries',
        'price' => 'Giá tiền',
    ],
    'button' => [
        'create' => 'Create',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'cancel' => 'Cancel',
    ],
    'switch' => [
        config('constants.status.public') => 'Active',
        config('constants.status.private') => 'Inactive',
    ],
];