<main class="results">
    <div class="container">
        <div class="results__title">
            <h1><?php echo $quiz->getTitle() ?></h1>
        </div>
        <div class="results__score">
            <p>
                <?php echo $score . " points" ?>
                <span>/</span>
                <span><?php echo $max_score?> points</span>
            </p>
        </div>
    </div>
    <div class="image">
        <img src="/frontend/assets/images/chubbs/chubbs-results.svg">
    </div>
</main>