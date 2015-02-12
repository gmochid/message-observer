<?php

return array(
	/**
     * Model title
     *
     * @type string
     */
    'title' => 'Status',
    /**
     * The singular name of your model
     *
     * @type string
     */
    'single' => 'Status',

    /**
     * The class name of the Eloquent model that this config represents
     *
     * @type string
     */
    'model' => 'Status',

    /**
     * The columns array
     *
     * @type array
     */
    'columns' => array(
        'status_id' => array(
            'title' => 'Status ID'
        ),
        'detail' => array(
            'title' => 'Detail',
        ),
    ),

    /**
     * The edit fields array
     *
     * @type array
     */
    'edit_fields' => array(
        'status_id' => array(
            'title' => 'Status ID'
        ),
        'detail' => array(
            'title' => 'Detail',
            'type' => 'text',
        ),
    ),

    /**
     * The sort options for a model
     *
     * @type array
     */
    'sort' => array(
        'field' => 'status_id',
        'direction' => 'asc',
    ),
);
