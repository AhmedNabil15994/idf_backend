<?php

return [
    'countries' => [
      'form'  => [
          'description'       => 'Description',
          'restore'           => 'Restore from trash',
          'meta_description'  => 'Meta Description',
          'meta_keywords'     => 'Meta Keywords',
          'status'            => 'Status',
          'title'             => 'Title',
          'type'              => 'In footer',
          'tabs'  => [
            'general'           => 'General Info.',
            'seo'               => 'SEO',
          ]
      ],
      'datatable' => [
          'created_at'    => 'Created At',
          'date_range'    => 'Search By Dates',
          'options'       => 'Options',
          'status'        => 'Status',
          'title'         => 'Title',
      ],
      'routes'     => [
          'create' => 'Create Countries',
          'index' => 'Countries',
          'update' => 'Update country',
      ],
      'validation'=> [
          'description'   => [
              'required'  => 'Please enter the description of country',
          ],
          'title'         => [
              'required'  => 'Please enter the title of country',
              'unique'    => 'This title country is taken before',
          ],
      ],
    ],
    'governorates' => [
      'form'  => [
          'description'       => 'Description',
          'restore'           => 'Restore from trash',
          'meta_description'  => 'Meta Description',
          'meta_keywords'     => 'Meta Keywords',
          'status'            => 'Status',
          'title'             => 'Title',
          'type'              => 'In footer',
          'tabs'  => [
            'general'           => 'General Info.',
            'seo'               => 'SEO',
          ]
      ],
      'datatable' => [
          'created_at'    => 'Created At',
          'date_range'    => 'Search By Dates',
          'options'       => 'Options',
          'status'        => 'Status',
          'title'         => 'Title',
      ],
      'routes'     => [
          'create' => 'Create governorates',
          'index' => 'governorates',
          'update' => 'Update country',
      ],
      'validation'=> [
          'description'   => [
              'required'  => 'Please enter the description of governorate',
          ],
          'title'         => [
              'required'  => 'Please enter the title of governorate',
              'unique'    => 'This title governorate is taken before',
          ],
      ],
    ],
    'cities' => [
      'form'  => [
          'governorate'         => 'Governorate',
          'description'       => 'Description',
          'restore'           => 'Restore from trash',
          'meta_description'  => 'Meta Description',
          'meta_keywords'     => 'Meta Keywords',
          'status'            => 'Status',
          'title'             => 'Title',
          'type'              => 'In footer',
          'tabs'  => [
            'general'           => 'General Info.',
            'seo'               => 'SEO',
          ]
      ],
      'datatable' => [
          'created_at'    => 'Created At',
          'date_range'    => 'Search By Dates',
          'options'       => 'Options',
          'status'        => 'Status',
          'title'         => 'Title',
          'governorate'         => 'Governorate',
      ],
      'routes'     => [
          'create' => 'Create cities',
          'index' => 'cities',
          'update' => 'Update country',
      ],
      'validation'=> [
          'description'   => [
              'required'  => 'Please enter the description of city',
          ],
          'title'         => [
              'required'  => 'Please enter the title of city',
              'unique'    => 'This title city is taken before',
          ],
          'governorate_id'         => [
              'required'  => 'Please select the governorate',
          ],
      ],
    ],
    'regions' => [
      'form'  => [
          'city'         => 'City',
          'description'       => 'Description',
          'restore'           => 'Restore from trash',
          'meta_description'  => 'Meta Description',
          'meta_keywords'     => 'Meta Keywords',
          'status'            => 'Status',
          'title'             => 'Title',
          'type'              => 'In footer',
          'tabs'  => [
            'general'           => 'General Info.',
            'seo'               => 'SEO',
          ]
      ],
      'datatable' => [
          'created_at'    => 'Created At',
          'date_range'    => 'Search By Dates',
          'options'       => 'Options',
          'status'        => 'Status',
          'title'         => 'Title',
          'city'         => 'City',
      ],
      'routes'     => [
          'create' => 'Create regions',
          'index' => 'regions',
          'update' => 'Update country',
      ],
      'validation'=> [
          'description'   => [
              'required'  => 'Please enter the description of region',
          ],
          'title'         => [
              'required'  => 'Please enter the title of region',
              'unique'    => 'This title region is taken before',
          ],
          'city_id'         => [
              'required'  => 'Please select the city',
          ],
      ],
    ],
];
