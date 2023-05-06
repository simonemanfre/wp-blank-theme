<?php
?>

    </main>

    <footer id="footer-content" class="c-site-footer">
        <div class="c-site-footer__content l-container">
            <?php the_field('contact_footer', 'option'); ?>
        </div>
    </footer>

	<?php wp_footer(); ?>
	
	<?php the_field('html_footer', 'option'); ?>   
    
</body>
</html>