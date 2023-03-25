<?php

function ai_adicionando_recursos_ao_tema(){
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'ai_adicionando_recursos_ao_tema');


function ai_registrando_menu(){
    register_nav_menu(
        'menu-navegacao',
        'Menu navegação'
    );
}

add_action('init', 'ai_registrando_menu');

function ai_post_customizado(){
    register_post_type('destinos', [
        'labels' => ['name' => 'Destinos'],
        'public' => true,
        'menu_position' => 0,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-admin-site'
    ]);
}
add_action('after_setup_theme', 'ai_post_customizado');