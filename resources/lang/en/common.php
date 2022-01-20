<?php

return [
    'title' => [
        'id' => 'ID',
        'title' => 'Title',
        'active' => 'Active',
        'description' => 'Description',
        'filter' => 'Filter',
        'action' => 'Action',
    ],
    'button' => [
        'create' => 'Create',
    ],
    'switch' => [
        config('constants.status.public') => 'Active',
        config('constants.status.private') => 'Inactive',
    ],
];