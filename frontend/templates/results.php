<body>
    <div class="results">
        <div class="results__title">
            <?php echo $quiz->getTitle() ?>
        </div>
        <div class="results__score">
            <p>
                <?php echo $score . " points" ?>
                <span>/</span>
                <?php echo $max_score ?>
            </p>
        </div>
    </div>
</body>
</html>