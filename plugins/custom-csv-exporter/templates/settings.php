<div class="wrap">
    <h2> Export Dealers</h2>
    <form method="post" action="options.php"> 
        <?php @settings_fields('wp_ccsve-group'); ?>
        <?php @do_settings_fields('wp_ccsve-group'); ?>

        <?php do_settings_sections('wp_ccsve_template'); ?>
        <?php @submit_button(); ?>
        
        <div id="exportCustomDesign" style="position: absolute;top: 160px;">
            <a class="ccsve_button" href="options-general.php?page=wp_ccsve_template&export=yes" 
               style="background: #008ec2;border-color: #006799;color: #fff;text-decoration: none;padding:10px">Export Dealers List</a>
        </div>
    </form>
</div>
