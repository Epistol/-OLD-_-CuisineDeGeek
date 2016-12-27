<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 23/09/2016
 * Time: 18:49
 */

?>

<div class='menu_aside_admin'>
    <ul class="menu_items">
        <?php

        $i = 0;


        foreach ($liens as $link) {

            ?>
            <li>
                <a class='<?= $class; ?>' href='<?= $liens[$i]; ?>'>

                    <?= $noms[$i] ?>

                </a>
            </li>
            <?php
            $i++;

        }
        ?>
    </ul>
</div>
