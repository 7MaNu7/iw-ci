    <?php foreach($js_files as $file): ?>
    <script src="<?=explode("htdocs",FCPATH)[1] . $file?>" type="text/javascript"></script>
    <?php endforeach; ?>
</body>
</html>
