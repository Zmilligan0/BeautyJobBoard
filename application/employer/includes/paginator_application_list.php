<?php if ($count_of_records > $limit) : ?>
    <div class="pages">
        <ul class="pagination">
            <?php
            $next_page = $page + 1;
            $previous_page = $page - 1;
            $page_limiter = 5;

            $query_string = THIS_PAGE . "?id=$id&applicant-search=$applicant_search&date-apply=$date_apply&page=";
            ?>


            <div class="d-flex flex-row-reverse">
                <div class="d-flex flex-column-reverse">
                    <p class="text-muted mb-0">Page <b><?= $page; ?></b> of <b><?= $number_of_pages ?></b></p>
                    <div class="col-auto">
                        <div class=" d-inline-block ms-auto mb-0">
                            <div class="p-2">
                                <nav aria-label="Page navigation example" class="mb-0">
                                    <ul class="pagination mb-0">
                                        <li class="page-item">
                                            <?php if ($page > 1) : ?>
                                                <a class="page-link" href=" <?php echo "$query_string$previous_page"; ?>">
                                                    «</a>
                                        </li>
                                    <?php else : ?>
                                        <span class="page-link text-muted" href=" <?php echo "$query_string$previous_page"; ?>">
                                            «</span>
                                        </li>
                                    <?php endif ?>
                                    <?php for ($i = 1; $i <= $number_of_pages; $i++) : ?>

                                        <?php if ($i == $page) : ?>
                                            <li class="page-item"><span class="page-link active" disabled><?php echo $i; ?></span></li>
                                        <?php else : ?>
                                            <?php if ($i > $page_limiter) : ?>
                                                <li class="page-item"><span class="page-link text-muted">...</span></li>
                                                <li class="page-item"><a class="page-link " href="<?php echo "$query_string$i"; ?>"><?php echo $i; ?></a></li>
                                                <?php break; ?>
                                            <?php endif ?>
                                            <li class="page-item"><a class="page-link " href="<?php echo "$query_string$i"; ?>"><?php echo $i; ?></a></li>
                                        <?php endif ?>


                                    <?php endfor ?>
                                    <?php if ($page < $number_of_pages) : ?>
                                        <li class="page-item"><a class="page-link" href="<?php echo "$query_string$next_page"; ?>">»</a></li>
                                    <?php else : ?>
                                        <li class="page-item"><span class="page-link text-muted" href="<?php echo "$query_string$next_page"; ?>">»</span></li>
                                    <?php endif ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif ?>