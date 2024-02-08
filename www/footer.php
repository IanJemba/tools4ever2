<?php if (isset($sql)) : ?>
    <div class="sql-statement">
        <?php if (!is_array($sql)) : ?>
            <p><strong>SQL Statement: </strong><span id="sql-statement"><?php echo htmlspecialchars($sql); ?></span></p>
        <?php else : ?>
            <?php foreach ($sql as $s) : ?>

                <p><strong>SQL Statement: </strong><span class="sql-statements"><?php echo htmlspecialchars($s); ?></span></p>

            <?php endforeach; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>
<script src="js/script.js"></script>
</body>

</html>