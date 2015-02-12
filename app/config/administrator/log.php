<?php

return array(
	/**
     * Model title
     *
     * @type string
     */
    'title' => 'Log',
    /**
     * The singular name of your model
     *
     * @type string
     */
    'single' => 'Log',

    /**
     * The class name of the Eloquent model that this config represents
     *
     * @type string
     */
    'model' => 'Logs',

    /**
     * The columns array
     *
     * @type array
     */
    'columns' => array(
        'id' => array(
            'title' => 'Log ID',
        ),
        'username' => array(
            'title' => 'Username'
        ),
        'no' => array(
            'title' => 'No',
        ),
        'status_id' => array(
            'title' => 'Status ID',
        ),
    ),

    /**
     * The edit fields array
     *
     * @type array
     */
    'edit_fields' => array(
        'id' => array(
            'title' => 'Log ID',
        ),
        'username' => array(
            'title' => 'Username'
        ),
        'no' => array(
            'title' => 'No',
        ),
        'status_id' => array(
            'title' => 'Status ID',
        ),
    ),

    /**
     * The sort options for a model
     *
     * @type array
     */
    'sort' => array(
        'field' => 'id',
        'direction' => 'asc',
    ),
);
