<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "โปรโมทไลน์ฟรีที่ Linepop.in.th", // set false to total remove
            'description'  => 'โปรโมทไลน์ฟรี ไม่มีค่าใช้จ่าย เพียงแค่สมัคร์สมาชิกแล้วทำการโปรโมทด้วยตัวเองได้เลย', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => ['โปรโมทไลน์, โปรโมทไลน์ฟรี, โปรโมทสติ๊กเกอร์ไลน์ฟรี, โปรโมทธีมไลน์ฟรี, โปรโมทอิโมจิไลน์ฟรี, line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ, อิโมจิ'],
            'canonical'    => false, // Set null for using Url::current(), set false to total remove
        ],

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
        ],
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'โปรโมทสติ๊กเกอร์ไลน์ฟรีกับ Linepop.in.th', // set false to total remove
            'description' => 'โปรโมทไลน์ฟรี ไม่มีค่าใช้จ่าย เพียงแค่สมัคร์สมาชิกแล้วทำการโปรโมทด้วยตัวเองได้เลย', // set false to total remove
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => false,
            'site_name'   => false,
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
          //'card'        => 'summary',
          //'site'        => '@LuizVinicius73',
        ],
    ],
];
