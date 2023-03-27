<?php get_header() ?>


    <form action="#" class="container-alura formulario-pesquisa-paises">
        <h2>Conheça nossos destinos</h2>
        <select name="paises" id="paises">
            <option value="">--Selecione--</option>
            <?php
            $paises = get_terms(array('taxonomy' => 'paises'));
            foreach ($paises as $pais):?>
                <option value="<?= $pais->name ?>"
                    <?= !empty($_GET['paises']) && $_GET['paises'] === $pais->name ? 'selected' : '' ?>><?= $pais->name ?></option>
            <?php endforeach;
            ?>
        </select>
        <input type="submit" value="Pesquisar">
    </form>

<?php
if(!empty($_GET['paises'])) {
    $paisSelecionado = array(array(
        'taxonomy' => 'paises',
        'field' => 'name',
        'terms' => $_GET['paises']
    ));
}

$args = array(
    'post_type' => 'destinos',
    'tax_query' => !empty($_GET['paises']) ? $paisSelecionado : ''
);
$query = new WP_Query($args);

if ($query->have_posts()):
    while ($query->have_posts()):
        $query->the_post();
        the_post_thumbnail();
        the_title();
        the_content();
    endwhile;
endif;
?>

<?php
    $args = array(
    'post_type' => 'banners',
    'post_status' => 'publish',
    'posts_per_page' => 1
    );

    $query = new WP_Query($args);
    if($query->have_posts()):
    while($query->have_posts()): $query->the_post();
    ?>
    <main>
        <div class="imagem-banner">
            <?php the_post_thumbnail(); ?>
        </div>
        <div class="texto-banner-dinamico">
            <p id="texto-banner"><?php the_title(); ?></p>
            <p id="texto-banner"><?= get_post_meta(get_the_ID(), "_texto_home_1", true); ?></p>
            <p id="texto-banner"><?= get_post_meta(get_the_ID(), "_texto_home_2", true); ?></p>
        </div>
    </main>
<?php
endwhile;
endif;
?>

<?php get_footer() ?>