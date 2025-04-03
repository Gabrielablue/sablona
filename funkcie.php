<?php

function pozdrav() {
    $hour = date('H');
    if ($hour < 12) {
        echo "<h3>Dobré ráno</h3>";
    } elseif ($hour < 18) {
        echo "<h3>Dobrý deň</h3>";
    } else {
        echo "<h3>Dobrý večer</h3>";
    }
}

function validateMenuType(string $type): bool
{
    $menuTypes = [
        'header',
        'footer',
    ];
        return in_array($type, $menuTypes);
}
function getMenuData(string $type): array
{
    $menu = [];
    if (validateMenuType($type)) {
        if ($type == "header") {
            $menu = [
                'home' => [
                    'name' => 'Domov',
                    'path' => 'index.php',
                ],
                'portfolio' => [
                    'name' => 'Portfólio',
                    'path' => 'portfolio.php',
                ],
                'qna' => [
                    'name' => 'Q&A',
                    'path' => 'qna.php',
                ],
                'kontakt' => [
                    'name' => 'Kontakt',
                    'path' => 'kontakt.php',
                ]
            ];
        } elseif ($type == "footer") {
            $menu = [
                'home' => [
                    'name' => 'Domov',
                    'path' => 'index.php',
                ],
                'qna' => [
                    'name' => 'Q&A',
                    'path' => 'qna.php',
                ],
                'kontakt' => [
                    'name' => 'Kontakt',
                    'path' => 'kontakt.php',
                ]
            ];
        }
    }
    return $menu;
}

function printMenu(array $menu)
{
    foreach ($menu as $menuName => $menuData) {
        echo '<li><a href="'.$menuData['path'].'">'.$menuData['name'].'</a></li>';
    }
}


function preparePortfolio(int $numberOfRows = 2, int $numberOfCols = 4): array{
    $portfolio = [];
    $colIndex = 1;
    for ($i = 1; $i <= $numberOfRows; $i++) {
        for($j = 1; $j <= $numberOfCols; $j++) {
            $portfolio[$i][$j] = $colIndex;
            $colIndex++;
        }
    }
    return $portfolio;
}

function finishPortfolio() {
    $portfolioData = preparePortfolio();
    $data = json_decode(file_get_contents("data/datas.json"), true);
    foreach ($portfolioData as $row => $col) {
        echo '<div class="row">';
        foreach ($col as $index) {
            $text = $data["portfolio-text-url"]["portfolio{$index}.jpg"]["text"];
            $link = $data["portfolio-text-url"]["portfolio{$index}.jpg"]["link"];
            echo '<a id="portfolio-' . $index . '" class="col-25 portfolio" href="' . $link . '">';
            echo '    <div class="text-center">';
            echo          $text;
            echo '    </div>';
            echo '</a>';
        }
        echo '</div>';
    }
}

?>