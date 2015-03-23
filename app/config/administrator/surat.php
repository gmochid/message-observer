<?php

return array(
	/**
     * Model title
     *
     * @type string
     */
    'title' => 'Surat',
    /**
     * The singular name of your model
     *
     * @type string
     */
    'single' => 'Surat',

    /**
     * The class name of the Eloquent model that this config represents
     *
     * @type string
     */
    'model' => 'Surat',

    /**
     * The columns array
     *
     * @type array
     */
    'columns' => array(
        'no' => array(
            'title' => 'No'
        ),
        'perihal' => array(
            'title' => 'Perihal',
        ),
        'asal' => array(
            'title' => 'Asal Surat',
        ),
        'keterangan' => array(
            'title' => 'Keterangan',
        ),
        'tanggal' => array(
            'title' => 'Tanggal Surat',
        ),
        'final' => array(
            'title' => 'Final',
        ),
    ),

    /**
     * The edit fields array
     *
     * @type array
     */
    'edit_fields' => array(
        'no' => array(
            'title' => 'No',
        ),
        'perihal' => array(
            'title' => 'Perihal',
            'type' => 'text',
        ),
        'asal' => array(
            'title' => 'Asal Surat',
            'type' => 'text',
        ),
        'keterangan' => array(
            'title' => 'Keterangan',
            'type' => 'text',
        ),
        'tanggal' => array(
            'title' => 'Tanggal Surat',
            'type' => 'date',
        ),
        'final' => array(
            'title' => 'Final',
        ),
    ),

    /**
     * The sort options for a model
     *
     * @type array
     */
    'sort' => array(
        'field' => 'no',
        'direction' => 'asc',
    ),
);
