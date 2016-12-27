<div class="ui main container segment" >

    <h1>Liste des recettes</h1>



    <div class="ui container-fluid">

        <!-- Contact Chip -->
        <a href='/recette/ajouter'>
            <button class="ui primary basic labeled icon button">
                <i class="plus icon"></i>  Ajouter une recette
            </button> </a>



        <div class="ui hidden divider"></div>



        <div class="ui stackable two column grid">
            <div class="column">
                <div class="ui divided items">

                    <?php $col_one_lim = $limite / 2;


                    ?>


                    <?=  $this->controller->get_tout_recettes($col_one_lim,$debut)
                    ?>

                </div>
            </div>
            <div class="column">
                <div class="ui divided items">


                    <?php

                    $col_two_start = $debut + $col_one_lim;





                    echo $this->controller->get_tout_recettes($col_one_lim,$col_two_start);
                    $max_page = $this->controller->get_max_pages();

                    ?>

                </div>
            </div>
        </div>

        <div class="ui hidden divider"></div>


        <nav class="ui pagination menu" aria-label="Page navigation">

            <?php if($page == 1){
                echo '
                         <a href="#" class="disabled item" aria-label="Previous">
                       &laquo;
                    </a>';
            }
            else {
                $prec = $page - 1;
                echo '
                 <a href="/recettes/page?page='.$prec.'" aria-label="Previous" class="item">
                        <span aria-hidden="true">&laquo;</span>
                    </a>';
            }
            ?>



            <?php
            for($i = 1; $i <= $max_page; $i++){
                if($page == $i){

                    $current = '<a class=" item active">'.$i.'</a>';
                }
                else {

                    $current = '';
                }
                echo "   <a href='/recettes/page?page=".$i."'>".$current."</a>";

            }


            if($page == $max_page){
                echo '
                         <a href="#" aria-label="Next" class="item disabled"aria-hidden="true">
                       &raquo;
                    </a>';
            }
            else {
                $prec = $page + 1;
                echo '
                 <a href="/recettes/page?page='.$prec.'" aria-label="Next">
                        <div class="item" aria-hidden="true">&raquo;</span>
                    </a>';
            }
            ?>

            </li>

        </nav>
    </div>




    <script>

        $('.special.cards .image').dimmer({
            on: 'hover'
        });

        $(' .rating')
            .rating({

                maxRating: 3
            })
        ;
    </script>




