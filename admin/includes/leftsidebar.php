            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title">Menu Amministratore</li>

                            <li class="has_sub">
                                <a href="dashboard.php" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>

                            </li>
                            <?php if ($_SESSION['utype'] == '1') : ?>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted"></i> <span> Admin Secondari </span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="add-subadmins.php">Aggiungi secondo admin</a></li>
                                        <li><a href="manage-subadmins.php">Gestisci admin secondari</a></li>
                                    </ul>
                                </li>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted"></i> <span> Mail </span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="setup-stmp.php">Setup STMP</a></li>
                                        <li><a href="setup-dest.php">Destinatari</a></li>
                                        <li><a href="setup-mess.php">Messaggi</a></li>
                                    </ul>
                                </li>
                                <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted"></i> <span> Gestione DATABASE </span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="exe-query.php">Esegui query</a></li>
                                        <li><a href="setup-dest.pphp">Destinatari</a></li>
                                        <li><a href="setup-mess.php">Messaggi</a></li>
                                        <li><a href="manage-orari.php">Gestione orari</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>



                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted"></i> <span> Categorie </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="add-category.php">Aggiungi categoria</a></li>
                                    <li><a href="manage-categories.php">Gestisci categorie</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted"></i> <span> Sottocategorie </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="add-subcategory.php">Aggiungi sottocategoria</a></li>
                                    <li><a href="manage-subcategories.php">Gestisci sottocategorie</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted"></i> <span> Notizie </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="add-post.php">Aggiungi notizia</a></li>
                                    <li><a href="add-live.php">Aggiungi live news</a></li>
                                    <li><a href="manage-posts.php">Gestisci notizie</a></li>
                                    <li><a href="trash-posts.php">Notizie cancellate</a></li>
                                </ul>
                            </li>


                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted"></i> <span> Pagine </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="aboutus.php">Informazioni</a></li>
                                    <li><a href="contactus.php">Contatti</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted"></i> <span> Commenti </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="unapprove-comment.php">In attesa di approvazione</a></li>
                                    <li><a href="manage-comments.php">Commenti approvati</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>



                </div>
                <!-- Sidebar -left -->

            </div>