  <?php 
    require_once('database/Database.php');
    $db = new Database();
    $cemple = $_SESSION['logged_cemple'];


    //traer todo el menu principal
    $sql = "SELECT modulosxe_cle2, modulosxe_cle3, modulosxe_encab, modulosxe_gchabilita, modulosxe_link
            FROM modulosxe 
            WHERE  modulosxe_gchabilita = '.T.'
               AND modulosxe_renglon between 1 and 2 
               AND  modulosxe_cemple = ?
             GROUP BY modulosxe_cle2, modulosxe_cle3, modulosxe_encab, modulosxe_gchabilita, modulosxe_link
            ORDER BY modulosxe_encab,modulosxe_link ASC
           ";

   $menuu = $db->getRows($sql, [$cemple]);

 ?>   
                            <li>
                                <a href="#pageSubmenu2">
                                    <div class="item-content">
                                        <div class="item-media">
                                            <i class="ti-pencil-alt"></i>
                                        </div>
                                        <div class="item-inner">
                                            <span class="title"> Book Appointment2 </span>
                                        </div>
                                    </div>
                        <ul class="dropdown-container" id="pageSubmenu2">
                            <li>
                                <a href="#">Page 1</a>
                            </li>
                            <li>
                                <a href="#">Page 2</a>
                            </li>
                            <li>
                                <a href="#">Page 3</a>
                            </li>
                        </ul> 
                                                       </a>
                            </li>

<!--                     <li>
                        <a href="#">About</a>
                        <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Otras</a>

                    </li> 
 -->
                    <?php
                        $v1 = "";
                    ?>
                    <?php foreach($menuu as $i): ?>
                         <?php if($i['modulosxe_link']=='#' AND $v1 != $i['modulosxe_cle2']){?>
                              <?php $v1 = $i['modulosxe_cle2'];?>
                                
                                </ul>
                              <!--FIN DE UL -->
                             </li> 
                          <!-- fin de li-->

                        <?php  } ?>             

                       <?php  if($i['modulosxe_link']=='#'){?>
                                <li> <a <?php echo 'href="#page'.$i['modulosxe_cle2'].'" data-toggle="collapse" aria-expanded="false" class="item-content">'.$i['modulosxe_cle2']?><i class="fa fa-reddit-alien"></i></a>
                                    <ul <?php echo 'class="item-media" id="page'.$i['modulosxe_cle2'].'">'?>
                        <?php }else{ ?>
                            <li>
                                <a <?php echo 'href="'.$i['modulosxe_link'].'.php">'.$i['modulosxe_cle3'];?></a></a>
                            </li> 
                       <?php  } ?>
                   <?php endforeach; ?>

            <!--
                <ul class="list-unstyled CTAs">
                    <li>
                        <a href="#" class="download">Download source</a>
                    </li>
                </ul>
            </nav>-->

                                 <!-- FIN DE UL 2-->
                                    </ul>
                               <!-- fin de li 2-->
                                </li>

            <!-- Page Content Holder 
            <div id="content">


                    </nav>	-->