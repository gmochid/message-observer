<?php

return array(
	/**
     * Model title
     *
     * @type string
     */
    'title' => 'User',
    /**
     * The singular name of your model
     *
     * @type string
     */
    'single' => 'User',

    /**
     * The class name of the Eloquent model that this config represents
     *
     * @type string
     */
    'model' => 'User',

    /**
     * The columns array
     *
     * @type array
     */
    'columns' => array(
        'username' => array(
            'title' => 'Username'
        ),
        'nickname' => array(
            'title' => 'Nickname',
        ),
        'created_at' => array(
            'title' => 'Waktu Didaftarkan',
        ),
        'updated_at' => array(
            'title' => 'Waktu Diperbarui',
        ),
    ),

    /**
     * The edit fields array
     *
     * @type array
     */
    'edit_fields' => array(
        'username' => array(
            'title' => 'Username',
            'type' => 'text',
        ),
        'password' => array(
            'title' => 'Password',
            'type' => 'password',
        ),
        'nickname' => array(
            'title' => 'Nickname',
            'type' => 'text',
        ),
    ),

    /**
     * The sort options for a model
     *
     * @type array
     */
    'sort' => array(
        'field' => 'username',
        'direction' => 'asc',
    ),
);
