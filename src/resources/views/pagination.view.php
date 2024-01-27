<?php if ($paginate->getTotalCount() > $paginate->getDefaultPerPage()) : ?>
    <div class="pagination">
        <p><?php echo $paginate->getTotalCount(); ?>件中 <?php echo $paginate->getFrom(); ?> - <?php echo $paginate->getTo(); ?>件目を表示</p>
        <div>
            <!-- 前へボタン -->
            <?php if ($paginate->getPage() > 1) : ?>
                <a href="<?php echo $paginate->prev(); ?>" class="link prev-next">&laquo;</a>
            <?php else : ?>
                <span class="prev-next unlink">&laquo;</span>
            <?php endif; ?>

            <!-- ページ番号 -->
            <?php for ($i = 1; $i <= $paginate->getTotalPageNumber(); ++$i) : ?>
                <?php if ($i >= $paginate->getPage() - $paginate->getRange() && $i <= $paginate->getPage() + $paginate->getRange()) : ?>
                    <?php if ($i === $paginate->getPage()) : ?>
                        <span class="page unlink current"><?php echo $i; ?></span>
                    <?php else : ?>
                        <a href="<?php echo $paginate->link($i); ?>" class="page link"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endfor; ?>

            <!-- 次へボタン -->
            <?php if ($paginate->getPage() === $paginate->getTotalPageNumber()) : ?>
                <span class="prev-next unlink">&raquo;</span>
            <?php else : ?>
                <a href="<?php echo $paginate->next(); ?>" class="link prev-next">&raquo;</a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
